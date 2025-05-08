<p align="center"><strong>Sistem Informasi Penjualan Alat Tulis</strong></p>

<div align="center">

![logo_unsulbar](public/LOGO.jpeg)



<b>Srynadila</b><br>
<b>D0222047</b><br>
<b>Framework Web Based</b><br>
<b>2025</b>
</div>

---
Berikut adalah contoh isi `README.md` untuk proyek Laravel dengan sistem role dan fitur-fiturnya:

---

# 📦 Sistem Informasi Penjualan Alat Tulis - Laravel

Ini adalah aplikasi web berbasis Laravel untuk mengelola penjualan alat tulis kantor, lengkap dengan sistem autentikasi dan manajemen role pengguna.

## 🧑‍💻 Teknologi yang Digunakan

* Laravel 10.x
* PHP 8.x
* MySQL / PostgreSQL
* Blade Template Engine
* Bootstrap / Tailwind CSS
* Laravel Breeze / Jetstream (untuk autentikasi)

---

## 🔐 Role & Hak Akses

### 1. 👑 Owner

* Mengakses seluruh data dan laporan
* Melihat statistik penjualan
* Mengelola data admin dan pembeli
* Menambah, mengedit, dan menghapus produk
* Melihat transaksi yang dilakukan oleh admin dan pembeli

### 2. 🧑‍💼 Admin

* Mengelola data produk (CRUD)
* Melihat daftar pembeli
* Menginput transaksi penjualan
* Melihat laporan penjualan

### 3. 🛒 Pembeli

* Melihat daftar produk
* Menambahkan produk ke keranjang
* Melakukan checkout pembelian
* Melihat riwayat transaksi sendiri

---


### 1. `user`

| Nama Field  | Tipe Data    | Keterangan                  |
| ----------- | ------------ | --------------------------- |
| id          | BIGINT       | Primary key, auto increment |
| name        | VARCHAR(255) | Nama lengkap pengguna       |
| email       | VARCHAR(255) | Email unik                  |
| password    | VARCHAR(255) | Password terenkripsi        |
| role        | ENUM         | `owner`, `admin`, `pembeli` |
| created\_at | TIMESTAMP    | Waktu dibuat                |
| updated\_at | TIMESTAMP    | Waktu diubah terakhir       |

---

### 2. `products`

| Nama Field  | Tipe Data     | Keterangan                  |
| ----------- | ------------- | --------------------------- |
| id          | BIGINT        | Primary key, auto increment |
| name        | VARCHAR(255)  | Nama produk                 |
| description | TEXT          | Deskripsi produk            |
| price       | DECIMAL(10,2) | Harga produk                |
| stock       | INT           | Jumlah stok                 |
| created\_at | TIMESTAMP     | Waktu dibuat                |
| updated\_at | TIMESTAMP     | Waktu diubah terakhir       |

---

### 3. `carts`

| Nama Field  | Tipe Data | Keterangan                  |
| ----------- | --------- | --------------------------- |
| id          | BIGINT    | Primary key, auto increment |
| user\_id    | BIGINT    | Relasi ke tabel `user`     |
| product\_id | BIGINT    | Relasi ke tabel `products`  |
| quantity    | INT       | Jumlah item yang dibeli     |
| created\_at | TIMESTAMP | Waktu dibuat                |
| updated\_at | TIMESTAMP | Waktu diubah terakhir       |

---

### 4. `transactions`

| Nama Field   | Tipe Data     | Keterangan                                |
| ------------ | ------------- | ----------------------------------------- |
| id           | BIGINT        | Primary key, auto increment               |
| user\_id     | BIGINT        | Relasi ke `user` (sebagai pembeli)       |
| total\_price | DECIMAL(10,2) | Total harga semua produk dalam transaksi  |
| status       | ENUM          | `pending`, `paid`, `shipped`, `completed` |
| created\_at  | TIMESTAMP     | Waktu dibuat                              |
| updated\_at  | TIMESTAMP     | Waktu diubah terakhir                     |

---

### 5. `transaction_items`

| Nama Field      | Tipe Data     | Keterangan                     |
| --------------- | ------------- | ------------------------------ |
| id              | BIGINT        | Primary key, auto increment    |
| transaction\_id | BIGINT        | Relasi ke tabel `transactions` |
| product\_id     | BIGINT        | Relasi ke tabel `products`     |
| quantity        | INT           | Jumlah produk dalam transaksi  |
| subtotal        | DECIMAL(10,2) | Harga x jumlah                 |
| created\_at     | TIMESTAMP     | Waktu dibuat                   |
| updated\_at     | TIMESTAMP     | Waktu diubah terakhir          |

---

## 🔗 Jenis Relasi dan Tabel yang Berelasi

| **Tabel Awal** | **Tabel Tujuan**    | **Jenis Relasi** | **Field yang Berelasi**                                | **Deskripsi**                                                                                                                               |
| -------------- | ------------------- | ---------------- | ------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------- |
| `user`        | `carts`             | One-to-Many      | `user.id` → `carts.user_id`                           | Setiap **user** dapat memiliki banyak **cart** (keranjang belanja), dan setiap **cart** hanya dimiliki oleh satu **user**.                  |
| `products`     | `carts`             | Many-to-Many     | `products.id` → `carts.product_id`                     | Sebuah **produk** dapat berada di banyak **keranjang** (cart), dan sebuah **keranjang** (cart) dapat berisi banyak **produk**.              |
| `users`        | `transactions`      | One-to-Many      | `user.id` → `transactions.user_id`                    | Setiap **user** (pembeli) dapat melakukan banyak **transaksi**, dan setiap **transaksi** hanya bisa dilakukan oleh satu **user**.           |
| `transactions` | `transaction_items` | One-to-Many      | `transactions.id` → `transaction_items.transaction_id` | Setiap **transaksi** dapat memiliki banyak **transaction\_item**, dan setiap **transaction\_item** hanya terkait dengan satu **transaksi**. |
| `products`     | `transaction_items` | Many-to-Many     | `products.id` → `transaction_items.product_id`         | Setiap **produk** dapat muncul di banyak **transaction\_item**, dan setiap **transaction\_item** hanya berisi satu **produk**.              |

---




