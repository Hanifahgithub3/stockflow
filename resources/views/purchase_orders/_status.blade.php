@php
    $map = [
        'draft' => 'secondary',
        'submitted' => 'primary',
        'partially_received' => 'warning text-dark',
        'completed' => 'success',
        'cancelled' => 'danger',
    ];
@endphp
<span class="badge bg-{{ $map[$status] ?? 'secondary' }}">{{ ucwords(str_replace('_', ' ', $status)) }}</span>