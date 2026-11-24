# Cannypedia Online Shop

Aplikasi toko online berbasis web menggunakan PHP, SQLite/MySQL, dan CSS responsif.

## Fitur

- Login/register customer dan admin
- CRUD kategori serta produk beserta upload gambar
- Dashboard pesanan admin
- Katalog, keranjang, checkout, dan riwayat pesanan
- Password hashing menggunakan `password_hash()`

## Persyaratan

- PHP 8.1+
- Ekstensi PDO SQLite atau PDO MySQL
- PHP Built-in Server

## Menjalankan Lokal

```bash
cd public
php -S localhost:8000
```

Buka `http://localhost:8000`. Database SQLite akan dibuat otomatis saat aplikasi pertama dijalankan.

## Akun Demo

Dibuat otomatis:

- Admin: `admin@cannypedia.com` / `admin123`
- Customer: `customer@cannypedia.com` / `customer123`

## Struktur Database

Menggunakan enam tabel utama:

- `users`
- `categories`
- `products`
- `orders`
- `order_items`
- `payments`
