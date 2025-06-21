# 🧾 Aplikasi Kasir Laravel

Aplikasi kasir sederhana berbasis web yang dibangun menggunakan Laravel 11. Dilengkapi dengan fitur transaksi, manajemen barang, dan pencetakan struk.

## ✅ Fitur Utama

- 🔧 **CRUD Barang** — Tambah, edit, hapus, dan lihat daftar barang.
- 💸 **Transaksi Penjualan** — Tambah barang ke keranjang dan proses penjualan.
- 🔢 **Hitung Kembalian** — Otomatis menghitung kembalian setelah pembayaran.
- 🧾 **Cetak Struk** — Struk transaksi bisa dicetak langsung.
- 🔐 **Login/Autentikasi** — Sistem login untuk mengakses aplikasi.

## 🛠️ Teknologi yang Digunakan

- [Laravel 11](https://laravel.com/)
- [Bootstrap](https://getbootstrap.com/)
- [MySQL](https://www.mysql.com/)
- PHP Session untuk menyimpan keranjang
- Blade Template

## ⚙️ Instalasi dan Setup Lokal

```bash
# Clone repository
git clone https://github.com/dms-euro/Kasir-app.git
cd Kasir-app

# Install dependency
composer install

# Salin file .env
copy .env.example .env

# Generate app key
php artisan key:generate

# Buat database baru di MySQL
# Import file SQL (db_project3.mysql) melalui phpMyAdmin / MySQL CLI

# Jalankan migrasi (opsional jika belum import SQL)
# php artisan migrate

# Jalankan server lokal
php artisan serve
