# Toko Online CodeIgniter 4

Proyek ini adalah platform toko online yang dibangun menggunakan [CodeIgniter 4](https://codeigniter.com/). Sistem ini menyediakan beberapa fungsionalitas untuk toko online, termasuk manajemen produk, keranjang belanja, sistem diskon dinamis, dan sistem transaksi yang komprehensif.

## Daftar Isi

- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Proyek](#struktur-proyek)

## Fitur

Berikut adalah rincian fitur yang telah diimplementasikan dalam proyek ini:

- **Katalog Produk**

  - Tampilan produk dalam format grid dengan gambar, nama, dan harga.
  - Pencarian produk.

- **Keranjang Belanja (Cart)**

  - Penambahan produk ke keranjang belanja dari halaman katalog.
  - Hapus produk dari keranjang.
  - Update jumlah (kuantitas) produk langsung di halaman keranjang.

- **Sistem Diskon Dinamis**

  - Manajemen Diskon (CRUD) oleh admin untuk mengatur diskon harian.
  - Validasi untuk memastikan tidak ada diskon pada tanggal yang sama.
  - Pengecekan diskon secara otomatis saat pengguna berhasil login.
  - Jika ada diskon aktif pada hari itu, nominalnya akan disimpan di session pengguna.
  - Tampilan nominal diskon hari ini secara dinamis di header website untuk pengguna yang sedang login.

- **Sistem Transaksi**

  - Proses checkout dari keranjang belanja.
  - Riwayat transaksi yang menampilkan daftar semua transaksi yang pernah dilakukan.
  - Setiap entri riwayat dapat diekspansi untuk melihat detail item yang dibeli, termasuk gambar produk, nama, harga saat beli, dan jumlah.

- **Panel Admin**

  - Manajemen Produk (Tambah, Baca, Ubah, Hapus).
  - Manajemen Kategori Produk (Tambah, Baca, Ubah, Hapus).
  - Manajemen Diskon Harian (Tambah, Baca, Ubah, Hapus).
  - Melihat daftar transaksi yang masuk.

- **Sistem Autentikasi**

  - Halaman Login dan Registrasi untuk pengguna.
  - Manajemen sesi pengguna yang aman.
  - Integrasi dengan sistem diskon saat login.

- **UI & Database**
  - Tampilan antarmuka yang responsif menggunakan template **NiceAdmin**.
  - Pengelolaan struktur database yang bersih menggunakan **Migrations**.
  - Pengisian data awal yang mudah menggunakan **Seeders**.

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Web server (XAMPP, Laragon, dll.)
- Database (MySQL/MariaDB)

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone repository ini**

    ```bash
    git clone [https://github.com/SteveHandy/belajar-ci-tugas.git](https://github.com/SteveHandy/belajar-ci-tugas.git)
    cd belajar-ci-tugas
    ```

2.  **Install dependensi PHP**
    Jalankan Composer untuk mengunduh semua library yang dibutuhkan.

    ```bash
    composer install
    ```

3.  **Konfigurasi Environment dan Database**

    - Salin file `env` menjadi `.env`. File `.env` adalah tempat Anda menyimpan konfigurasi lokal.
      ```bash
      cp env .env
      ```
    - Buka file `.env` menggunakan teks editor.
    - Pastikan `CI_ENVIRONMENT` diatur ke `development`.
      ```
      CI_ENVIRONMENT = development
      ```
    - Nyalakan modul Apache dan MySQL pada XAMPP.
    - Buat database baru di phpMyAdmin dengan nama, misalnya, `db_ci4`.
    - Sesuaikan konfigurasi database pada file `.env` agar cocok dengan pengaturan lokal Anda.
      ```
      database.default.hostname = localhost
      database.default.database = db_ci4
      database.default.username = root
      database.default.password =
      database.default.DBDriver = MySQLi
      ```

4.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel yang dibutuhkan (`product`, `product_category`, `user`, `transaction`, `transaction_detail`, `diskon`, `migrations`.) secara otomatis berdasarkan file migrasi.

    ```bash
    php spark migrate
    ```

5.  **Isi Data Awal (Seeding)**
    Perintah ini akan mengisi tabel Anda dengan data awal yang sudah disiapkan agar aplikasi tidak kosong. Pastikan `DatabaseSeeder.php` utama memanggil semua seeder individual.

    ```bash
    php spark db:seed UserSeeder
    php spark db:seed ProductSeeder
    php spark db:seed DiskonSeeder
    ```

6.  **Jalankan Server Lokal**
    CodeIgniter memiliki server development bawaan yang praktis.

    ```bash
    php spark serve
    ```

7.  **Akses Aplikasi**
    Buka browser Anda dan akses `http://localhost:8080` untuk melihat halaman utama aplikasi.

## Struktur Proyek

Proyek ini menggunakan struktur direktori standar dari CodeIgniter 4 (MVC) dengan beberapa file kunci yang telah kita kembangkan.

- `app/`
  - `Config/`
    - `Routes.php`: Mendefinisikan URL kustom dan mengarahkannya ke metode Controller yang sesuai (misal: `/transaksi`).
  - `Controllers/` - Berisi logika utama aplikasi untuk menangani permintaan pengguna.
    - `AuthController.php`: Mengelola proses login, registrasi, dan logout.
    - `ProdukController.php`: Logika CRUD untuk data produk.
    - `DiskonController.php`: Logika CRUD untuk data diskon.
    - `TransaksiController.php`: Mengelola proses checkout dan menampilkan riwayat transaksi.
  - `Database/`
    - `Migrations/`: Berisi file-file untuk membuat dan memodifikasi skema database secara terstruktur. Contoh: `..._Diskon.php`.
    - `Seeds/`: Berisi file untuk mengisi data awal ke database.
      - `DatabaseSeeder.php`: Seeder utama.
      - `DiskonSeeder.php`: Mengisi data diskon untuk 10 hari.
      - `ProductSeeder.php`: Mengisi data produk awal.
  - `Models/` - Berisi kelas-kelas yang merepresentasikan tabel database dan menyediakan metode untuk berinteraksi dengannya.
    - `ProdukModel.php`: Interaksi dengan tabel `produk`.
    - `UserModel.php`: Interaksi dengan tabel `users`.
    - `DiskonModel.php`: Interaksi dengan tabel `diskon`, termasuk metode `getDiskonHariIni()`.
    - `TransaksiModel.php`: Interaksi dengan tabel `transaksi`.
    - `TransaksiDetailModel.php`: Interaksi dengan tabel `transaksi_detail`, termasuk metode `JOIN` ke tabel produk.
  - `Views/` - Berisi file-file HTML (template) yang akan ditampilkan kepada pengguna.
    - `layout.php`: Template utama yang digunakan oleh halaman lain.
    - `v_produk.php`: Halaman katalog produk.
    - `v_keranjang.php`: Halaman keranjang belanja.
    - `v_diskon.php`: Halaman CRUD untuk manajemen diskon di panel admin.
    - `v_transaksi.php`: Halaman untuk menampilkan riwayat transaksi dengan detail yang bisa diekspansi.
    - `partials/header.php`: Komponen header yang berisi logika untuk menampilkan diskon dinamis.
- `public/` - Direktori yang dapat diakses publik.
  - `img/`: Tempat untuk menyimpan gambar produk dan aset lainnya.
  - `NiceAdmin/`: Berisi semua aset (CSS, JS, gambar) dari template admin NiceAdmin.
- `.env`: File konfigurasi environment lokal (database, base URL, dll). **Tidak untuk di-commit ke Git.**
