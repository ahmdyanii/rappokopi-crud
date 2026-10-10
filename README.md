# ☕ Rappokopi Website

Website profil dan katalog menu interaktif untuk Rappokopi, kedai kopi lokal yang menyajikan berbagai varian kopi susu aren, non-kopi, seri creamy, americano, matcha, serta paket promo menarik. Website ini dibangun menggunakan PHP dan MySQL untuk mendukung pengelolaan data menu dan promo secara dinamis.

## 🚀 Fitur Utama

* Navigasi Website Responsif: Memudahkan pengguna berpindah antara bagian Beranda, Menu, Promo, dan Lokasi.

* Katalog Menu Interaktif: Menampilkan foto, nama, kategori, harga, dan deskripsi menu.

* Pencarian dan Filter Menu: Memudahkan pengguna mencari menu berdasarkan nama atau kategori sesuai fitur yang tersedia.

* Informasi Promo: Menampilkan foto, nama promo, harga, deskripsi, dan ketentuan promo.

* Informasi Lokasi: Menampilkan alamat kedai, jam operasional, serta tautan Google Maps.

* Desain Ramah Pengguna: Menggunakan palet warna hangat khas kedai kopi dan tipografi modern Plus Jakarta Sans.

* Integrasi Database MySQL: Menyimpan data menu, promo, dan akun admin dalam database bernama `rappokopi`.

* API Menu dan Promo: Menyediakan data menu dan promo dari database dalam format JSON melalui PHP.

* Login Admin: Memungkinkan admin masuk ke halaman pengelolaan menggunakan username dan password.

* Dashboard Admin: Menampilkan ringkasan data menu dan promo serta akses ke halaman pengelolaan.

* Pengelolaan Menu (CRUD): Admin dapat menambah, melihat, mengedit, dan menghapus data menu.

* Pengelolaan Promo (CRUD): Admin dapat menambah, melihat, mengedit, dan menghapus data promo.

* Upload Foto: Mendukung pengelolaan foto menu dan promo.

* Logout Admin: Mengakhiri sesi login dan mengarahkan admin kembali ke halaman login.

## 🛠️ Teknologi yang Digunakan

* HTML5: Menyusun struktur halaman website.

* CSS3: Mengatur warna, tata letak, dan tampilan responsif.

* Bootstrap 5.3.3: Membantu membangun komponen antarmuka dan tata letak.

* JavaScript: Mengatur interaksi pada halaman website.

* jQuery 3.7.1: Mendukung manipulasi data dan interaksi frontend jika digunakan pada kode.

* PHP: Mengolah data di sisi server, memproses login, dan menjalankan operasi CRUD.

* MySQL: Menyimpan data menu, promo, dan admin.

* AOS (Animate On Scroll): Mendukung efek animasi saat halaman digulir jika diaktifkan.

* Google Fonts – Plus Jakarta Sans: Menyediakan tipografi untuk tampilan website.

## 📂 Struktur Folder Proyek

```
rappokopi-pilihan/
│
├── admin/
│   ├── dashboard.php       # Halaman dashboard admin
│   ├── login.php           # Halaman dan proses login admin
│   ├── logout.php          # Proses logout admin
│   ├── menu.php            # Pengelolaan data menu
│   └── promo.php           # Pengelolaan data promo
│
├── api/
│   ├── menu.php            # Mengambil data menu dari database
│   └── promo.php           # Mengambil data promo dari database
│
├── images/                 # Folder gambar dan foto website
│
├── index.php               # Halaman utama website
├── koneksi.php             # Koneksi PHP ke database MySQL
├── README.md               # Dokumentasi proyek
├── script.js               # Logika interaktif frontend
├── style.css               # Pengaturan tampilan website
└── test.php                # File pengujian
```

## 🗃️ Database

Website menggunakan database MySQL bernama `rappokopi` dengan tabel utama sebagai berikut:

* Tabel `menu`: Menyimpan nama menu, kategori, harga, foto, dan deskripsi.

* Tabel `promo`: Menyimpan nama promo, harga, foto, deskripsi, dan ketentuan promo.

* Tabel `admin`: Menyimpan data akun untuk login admin.

File `koneksi.php` digunakan untuk menghubungkan aplikasi PHP dengan database MySQL.

## 🔄 Alur Sistem Website

### 1. Pengunjung

Pengunjung membuka halaman `index.php` untuk melihat informasi kedai, katalog menu, promo, dan lokasi. Data menu dan promo diambil melalui file `api/menu.php` dan `api/promo.php`, kemudian ditampilkan pada halaman website.

### 2. Admin

Admin membuka halaman `admin/login.php` dan memasukkan username serta password. Jika login berhasil, sistem mengarahkan admin ke `admin/dashboard.php`. Dari dashboard, admin dapat membuka halaman pengelolaan menu atau promo untuk menambah, melihat, mengedit, dan menghapus data. Perubahan data disimpan ke database MySQL. Setelah selesai, admin dapat memilih Logout untuk mengakhiri sesi login.

## ▶️ Cara Menjalankan Website

1. Buka aplikasi XAMPP.

2. Aktifkan layanan Apache dan MySQL.

3. Pastikan folder proyek berada di direktori `htdocs`.

4. Pastikan database `rappokopi` beserta tabel `menu`, `promo`, dan `admin` sudah tersedia.

5. Buka browser dan akses alamat berikut:

   ```
   http://localhost/rappokopi-pilihan/
   ```

6. Untuk masuk ke halaman admin, akses:

   ```
   http://localhost/rappokopi-pilihan/admin/login.php
   ```

7. Setelah berhasil login, gunakan dashboard untuk mengelola menu dan promo.

8. Setelah selesai, klik tombol Logout.

## 🎯 Tujuan Website

Website Rappokopi dikembangkan untuk menyediakan informasi kedai, menampilkan katalog menu dan promo secara interaktif, serta memudahkan pengelolaan data melalui halaman admin. Dengan menggunakan PHP dan MySQL, data menu dan promo dapat dikelola melalui sistem tanpa perlu mengubah isi halaman secara manual setiap kali terjadi perubahan data.
