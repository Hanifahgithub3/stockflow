<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    private const TRANSITIONS = [
        'draft' => ['submitted', 'cancelled'],
        'submitted' => ['cancelled'],
    ];

    public function index(Request $request)
    {
        $orders = PurchaseOrder::with('supplier')
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->latest('order_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('purchase_orders.index', compact('orders'));
    }

    public function create()
    {
        return view('purchase_orders.create', [
            'suppliers' => Supplier::orderBy('supplier_name')->get(),
            'products' => Product::orderBy('product_name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'order_date' => ['required', 'date'],
            'status' => ['required', 'in:draft,submitted'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'distinct', 'exists:products,id'],
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ]);

        $order = DB::transaction(function () use ($data) {
            $prefix = 'PO-' . now()->format('Ymd') . '-';

            $last = PurchaseOrder::where('po_number', 'like', $prefix . '%')
                ->lockForUpdate()
                ->orderByDesc('po_number')
                ->value('po_number');

            $next = $last ? ((int) substr($last, -4)) + 1 : 1;

            $order = PurchaseOrder::create([
                'supplier_id' => $data['supplier_id'],
                'po_number' => $prefix . str_pad($next, 4, '0', STR_PAD_LEFT),
                'order_date' => $data['order_date'],
                'status' => $data['status'],
                'total_amount' => 0,
                'created_by' => auth()->id(),
            ]);

            $total = 0;
            foreach ($data['items'] as $item) {
                $subtotal = round($item['quantity'] * $item['unit_price'], 2);

                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $order->update(['total_amount' => $total]);

            return $order;
        });

        return redirect()->route('purchase-orders.show', $order)
            ->with('success', 'Purchase Order ' . $order->po_number . ' berhasil dibuat.');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load(['supplier', 'creator', 'items.product']);

        return view('purchase_orders.show', ['order' => $purchaseOrder]);
    }

    public function updateStatus(Request $request, PurchaseOrder $purchaseOrder)
    {
        $new = $request->validate([
            'status' => ['required', 'in:submitted,cancelled'],
        ])['status'];

        $allowed = self::TRANSITIONS[$purchaseOrder->status] ?? [];

        if (! in_array($new, $allowed)) {
            return back()->with('error', 'Status PO tidak bisa diubah ke ' . $new . '.');
        }

        if ($new === 'cancelled'
            && DB::table('goods_receipts')->where('purchase_order_id', $purchaseOrder->id)->exists()) {
            return back()->with('error', 'PO tidak bisa dibatalkan karena sudah ada penerimaan barang.');
        }

        $purchaseOrder->update(['status' => $new]);

        return back()->with('success', 'Status PO diperbarui.');
    }
}