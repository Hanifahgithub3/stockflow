# StockFlow – Sistem Manajemen Inventaris

StockFlow adalah aplikasi manajemen inventaris berbasis web yang dikembangkan untuk mendukung pengelolaan produk, administrasi pemasok, proses pengadaan barang, dan pemantauan stok.

## Fitur Utama

- **Dashboard** – Menampilkan statistik inventaris dan informasi stok menipis
- **Manajemen Produk** – Mengelola data produk, kategori, dan informasi stok
- **Manajemen Kategori** – Mengelola kategori produk
- **Manajemen Pemasok** – Mengelola informasi dan kontak pemasok
- **Manajemen Purchase Order (PO)** – Membuat, mengelola, dan memantau pesanan pembelian
- **Dokumen Purchase Order** – Membuat dan mengunduh dokumen PO dalam format PDF
- **Goods Receipt (GR)** – Mencatat penerimaan barang berdasarkan Purchase Order
- **Penerimaan Parsial dan Penuh** – Mendukung pencatatan penerimaan barang secara bertahap maupun sekaligus
- **Pembaruan Stok Otomatis** – Memperbarui jumlah stok produk setelah transaksi penerimaan barang disimpan
- **Pemantauan Stok** – Memantau jumlah stok dan mengidentifikasi produk yang menipis
- **Hak Akses Berdasarkan Peran** – Membatasi akses fitur berdasarkan peran pengguna

## Alur Proses Bisnis

StockFlow mendukung alur pengadaan dan penerimaan barang sebagai berikut:

1. Membuat Purchase Order (PO)
2. Mengirimkan atau mengubah status PO menjadi submitted
3. Membuat dan mengunduh dokumen PO dalam format PDF
4. Mencatat penerimaan barang melalui Goods Receipt (GR)
5. Memperbarui stok inventaris secara otomatis
6. Memperbarui status PO berdasarkan jumlah barang yang telah diterima

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Bootstrap 5
- JavaScript
- Composer
- DomPDF

## Tujuan Pengembangan

StockFlow dikembangkan sebagai proyek portofolio untuk menunjukkan kemampuan dalam pengembangan aplikasi berbasis web, pengelolaan basis data, proses pengadaan barang, manajemen inventaris, serta pemahaman alur proses bisnis.
