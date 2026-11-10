# Sistem Pemesanan Kamar Hotel (JWD Luxury Hotel & Resorts)

> **Skema Sertifikasi / Okupasi Nasional:** JUNIOR WEB DEVELOPER  
> **Nomor Skema:** FR.SKEMA-02-07  
> **Kode Unit Uji / Bukti:** FR.IA.02 Tugas Praktik Demonstrasi  
> **Framework:** Laravel 11 / PHP 8.3  
> **Database:** MySQL / SQLite  

---

## 1. Deskripsi Aplikasi

Aplikasi **Sistem Pemesanan Kamar Hotel** adalah aplikasi web full-stack yang dikembangkan berdasarkan spesifikasi resmi uji kompetensi **Junior Web Developer (LSP Informatika / BNSP)**. Aplikasi ini memungkinkan pengguna untuk mengeksplorasi profil hotel, melihat foto dan video kamar hotel, membandingkan daftar harga dalam bentuk tabel harga resmi, mempelajari profil perusahaan di halaman tentang kami, serta melakukan pemesanan kamar dengan aturan kalkulasi dan validasi ketat.

---

## 2. Pemenuhan Seluruh Skenario Sertifikasi (FR.IA.02)

### A. Fitur Menu Utama (Butir C.1)
1. **Produk & Koleksi Kamar (`/` & `/harga`):**
   - Menampilkan foto berkualitas tinggi untuk minimal 3 jenis kamar (Standar, Deluxe, Executive, serta Family Suite).
   - Menampilkan **Video Pratinjau & Tur Kamar Hotel** interaktif untuk masing-masing tipe kamar (memenuhi butir 2.c).
2. **Daftar Harga (`/harga`):**
   - Menampilkan **Tampilan Tabel Harga Resmi** (`<table class="luxury-table-pricing">`) yang mencakup No, Foto & Jenis Kamar, Kapasitas & Luas, Fasilitas Utama, Tarif Normal per Malam, Tarif Diskon (> 3 Hari), dan Tombol Aksi Reservasi.
   - Dilengkapi juga dengan kartu komparasi visual interaktif serta pop-up detail kamar dengan tombol pemesanan instan per kategori.
3. **Tentang Kami (`/tentang`):**
   - Berisi uraian deskripsi lengkap profil hotel bintang lima.
   - Menyertakan **Alamat Properti Pusat** (Jl. Jend. Sudirman Kav. 21, Jakarta Selatan 12920).
   - Menyertakan **Nomor Telepon** ((021) 5790-1288 / +62 811-9872-1288).
   - Menyertakan **Alamat Email** (reservations@jwdhotel.co.id / concierge@jwdhotel.co.id).
   - Menampilkan portofolio 4 properti cabang hotel (Jakarta, Bali, Yogyakarta, Surabaya) serta fasilitas The Artisan Kitchen.
4. **Pesan Kamar (`/pesan`):**
   - Halaman formulir pemesanan kamar hotel yang terintegrasi dengan validasi dan kalkulasi otomatis.

---

### B. Skenario Form Pemesanan Kamar (Butir C.2.a)
Formulir pemesanan menerapkan aturan validasi ketat sisi klien (*JavaScript*) dan sisi server (*Laravel Controller Validation*):

| Field / Komponen | Tipe Input | Aturan & Validasi Resmi |
| :--- | :--- | :--- |
| **Nama Pemesan** | Text | Wajib diisi nama pemesan yang sah |
| **Jenis Kelamin** | Radio Button | Pilihan: `Laki-laki` atau `Perempuan` |
| **Nomor Identitas** | Text / Numeric | Wajib **tepat 16 digit angka**. Jika tidak tepat 16 digit muncul pesan error khusus: <br>`"isian salah..data harus 16 digit"` |
| **Tipe Kamar** | Dropdown Select | Pilihan kamar: `Standar`, `Deluxe`, `Executive`, `Family` |
| **Harga Kamar** | Text (Read-Only) | Otomatis terisi sesuai tipe kamar yang dipilih: <br>- Standar: Rp 350.000<br>- Deluxe: Rp 550.000<br>- Executive: Rp 850.000<br>- Family Suite: Rp 1.200.000 |
| **Tanggal Pesan** | Date Picker | Format tanggal `dd/mm/yyyy` (minimal tanggal hari ini) |
| **Durasi Menginap** | Number / Text | Wajib diisi angka (minimal 1 hari). Jika bukan angka muncul pesan: <br>`"harus isi angka"` |
| **Termasuk Breakfast** | Checkbox | Dicentang berarti **Ya** (+ Rp 80.000 / hari) |
| **Total Bayar** | Output / Display | Terisi otomatis saat menekan tombol **"Hitung Total Bayar"**, dengan rumus:<br>$$\text{Subtotal} = \text{Harga Kamar} \times \text{Durasi}$$<br>$$\text{Diskon} = \begin{cases} 10\% \times \text{Subtotal}, & \text{jika Durasi} > 3 \text{ hari} \\ 0, & \text{lainnya} \end{cases}$$<br>$$\text{Breakfast} = \begin{cases} 80.000 \times \text{Durasi}, & \text{jika dicentang} \\ 0, & \text{lainnya} \end{cases}$$<br>$$\text{Total Bayar} = \text{Subtotal} - \text{Diskon} + \text{Breakfast}$$ |
| **Tombol Aksi** | Buttons | - **Hitung Total Bayar**: Melakukan kalkulasi total dan memvalidasi NIK serta durasi.<br>- **Simpan Pemesanan**: Menyimpan data reservasi ke database.<br>- **Cancel**: Kembali ke halaman beranda / reset input. |

---

### C. Penyimpanan Database & Tampilan Riwayat (Butir C.2.b)
Hasil isian form pemesanan disimpan ke dalam tabel database `pemesanan_kamar` dan disajikan pada halaman **Riwayat Pemesanan (`/riwayat`)** dengan format tampilan faktur/invoice:
- **Nama Pemesan**
- **Nomor Identitas** (16 digit)
- **Jenis Kelamin**
- **Tipe Kamar**
- **Durasi Penginapan** (Hari)
- **Discount** (%)
- **Total Bayar** (Rp)
- Disertai fitur cetak invoice (*window.print()*) dan pembatalan/penghapusan data.

---

### D. Media Foto & Video Jenis Kamar (Butir C.2.c)
- Foto jenis kamar resolusi tinggi tersedia pada seluruh kartu kamar, tabel harga, formulir pemesanan, dan invoice riwayat.
- **Video jenis kamar** disematkan dalam bentuk pemutar video interaktif responsif pada halaman beranda lengkap dengan navigasi tab per jenis kamar (*Standar, Deluxe, Executive, Family*).

---

## 3. Struktur & Hirarki Folder (Arsitektur MVC)

Sesuai instruksi kerja unit kompetensi *Menyusun Fungsi, File atau Sumber Daya Pemrograman yang Lain dalam Organisasi yang Rapi*, berikut adalah struktur hirarki file proyek:

```text
hotel-jwd/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Controller.php
│   │       └── PemesananKamarController.php     # Controller utama (home, harga, tentang, formPesan, simpan, riwayat, hapus)
│   └── Models/
│       └── PemesananKamar.php                  # Model Eloquent pemesanan, casting, dan helper daftarHarga() & daftarLokasi()
│
├── database/
│   ├── migrations/
│   │   └── 2026_11_06_000001_create_pemesanan_kamar_table.php  # Skema tabel pemesanan kamar hotel
│   └── database.sqlite                         # File database SQLite (dapat dialihkan ke MySQL via .env)
│
├── public/
│   ├── images/
│   │   └── hero-banner.jpg                     # Aset foto arsitektur hotel beranda
│   ├── index.php                               # Front controller Laravel
│   └── robots.txt
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php                   # Master layout (Floating Navbar top-right, Lucide Icons, AOS, Footer)
│       ├── home.blade.php                      # Halaman Utama (Hero Banner, Carousel Kamar, Video Tur Kamar, Fasilitas)
│       ├── harga.blade.php                     # Halaman Daftar Harga (Kartu Tarif, Tabel Harga Resmi BNSP, Detail Modal)
│       ├── tentang.blade.php                   # Halaman Tentang Kami (Deskripsi Hotel, Alamat, No Telp, Email, Cabang)
│       ├── pesan.blade.php                     # Formulir Pemesanan Kamar (Validasi NIK 16 digit, Durasi Angka, Live Calc)
│       └── riwayat.blade.php                   # Halaman Riwayat & Invoice Pemesanan (Format ringkasan resmi BNSP)
│
├── routes/
│   └── web.php                                 # Definisi seluruh endpoint URL rute aplikasi web
│
├── tests/
│   └── Feature/
│       └── PemesananKamarTest.php              # Pengujian otomatis (Unit & Feature Test: 9 passed, 28 assertions)
│
├── artisan                                     # Antarmuka CLI Laravel Artisan
├── composer.json                               # Definisi dependensi PHP dan package library
├── package.json                                # Dependensi frontend
└── README.md                                   # Dokumentasi lengkap proyek sertifikasi
```

---

## 4. Panduan Menjalankan Aplikasi

### Persyaratan Sistem
- PHP versi 8.2 atau lebih tinggi (disarankan PHP 8.3)
- Composer package manager
- Web server XAMPP / Apache / Nginx
- Ekstensi PHP: `pdo_sqlite` atau `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`

### Langkah-langkah Instalasi
1. **Clone atau Buka Direktori Proyek:**
   ```bash
   cd "c:\Users\Glenn Marcel\hotel-jwd"
   ```

2. **Instal Dependensi PHP (bila belum terpasang):**
   ```bash
   composer install
   ```

3. **Konfigurasi Lingkungan (`.env`):**
   Salin file `.env.example` menjadi `.env` jika belum ada:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Jalankan Migrasi Database:**
   ```bash
   php artisan migrate
   ```

5. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui browser pada alamat: **`http://localhost:8000`** atau **`http://127.0.0.1:8000`**.

6. **Menjalankan Pengujian Otomatis (*Automated Tests*):**
   ```bash
   php artisan test
   ```
   Seluruh 9 skenario pengujian fungsional dan validasi akan terverifikasi secara otomatis.

---

## 5. Ringkasan Endpoint Rute URL

| Metode | URL | Nama Rute | Deskripsi Fungsi |
| :---: | :--- | :--- | :--- |
| `GET` | `/` | `home` | Halaman utama, hero banner, pratinjau kamar, video tur kamar, dan galeri fasilitas |
| `GET` | `/harga` | `harga` | Halaman daftar harga, tabel komparasi tarif resmi BNSP, dan pop-up modal rincian |
| `GET` | `/tentang` | `tentang` | Halaman tentang kami, kontak (alamat, no telp, email), dan profil cabang hotel |
| `GET` | `/pesan` | `pesan` | Halaman formulir pemesanan kamar hotel terpadu |
| `POST` | `/pesan` | `pesan.simpan` | Memproses validasi ketat, kalkulasi diskon & breakfast, dan menyimpan ke database |
| `GET` | `/riwayat` | `riwayat` | Menampilkan seluruh riwayat reservasi dan faktur invoice pemesanan |
| `DELETE` | `/riwayat/{pemesananKamar}` | `riwayat.hapus` | Menghapus data reservasi dari database |

---

*Dikembangkan untuk pemenuhan standar sertifikasi resmi Badan Nasional Sertifikasi Profesi (BNSP) & LSP Informatika.*
