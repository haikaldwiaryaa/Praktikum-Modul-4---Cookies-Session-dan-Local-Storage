# Praktikum Modul 4 - Penyimpanan Data pada Web: Cookies, Session, dan Local Storage

Repositori ini berisi seluruh hasil pengerjaan praktikum dan penugasan Modul 4 mata kuliah Pengembangan Aplikasi Web.

## 👤 Identitas Mahasiswa
- **Nama**: Muhamad Haikal Dwi Arya
- **NIM**: 018

---

## 📂 Struktur Repositori

```text
Praktikum-Modul-4/
├── Eksperimen Teori/
│   ├── langkah1.php - langkah3.php  (Eksperimen HTTP Stateless)
│   ├── cookie_dasar.php             (Cookie dasar & penghitung kunjungan)
│   ├── keranjang_cookie.php         (Keranjang belanja cookies & uji manipulasi)
│   ├── db_belajar.sql               (Skema database session)
│   ├── login.php, dashboard.php     (Autentikasi session PHP native)
│   ├── tema.html                    (Local Storage tema gelap/terang)
│   ├── keranjang_ls.html            (Local Storage keranjang belanja)
│   └── storage_beda.html            (Komparasi Local vs Session Storage)
│
├── tugas-1-login/                   (Tugas 1: Login dengan Password Terenkripsi - Laravel)
│   ├── AuthController               (Autentikasi manual tanpa starter kit)
│   ├── Migration & Seeder           (Tabel users dengan username & Bcrypt hash)
│   └── Middleware auth & guest      (Proteksi route)
│
├── tugas-2-keranjang/               (Tugas 2: Keranjang Belanja Tanpa Login - Laravel)
│   ├── CartController               (Pengelolaan session keranjang belanja)
│   ├── Model & Seeder Barang        (5 produk alat tulis)
│   └── Antarmuka Blade              (Daftar barang & halaman keranjang)
│
└── tugas-3-toko-online/             (Tugas Integrasi: Program Toko Online Lengkap - Laravel)
    ├── 4 Tabel Database             (users, products, orders, order_details)
    ├── Hak Akses                    (Katalog publik, belanja & checkout wajib login)
    ├── Manajemen Stok               (Validasi stok gudang, stok 0 tidak dapat dibeli)
    ├── Transaksi Checkout           (DB Transaction: catat pesanan, potong stok, flush keranjang)
    └── Riwayat Pesanan              (Daftar transaksi dan detail item yang dibeli)
```

---

## ⚙️ Persyaratan Sistem
- PHP >= 8.3
- Composer
- MySQL Database (Laragon / XAMPP)
