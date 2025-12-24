# PTMSI Sumatera Barat - Sistem Manajemen Tenis Meja

Aplikasi web untuk manajemen data atlet, klub, pelatih, turnamen, dan ranking tenis meja di Sumatera Barat.

## Teknologi

- **Framework**: CodeIgniter 4
- **Database**: MySQL
- **PHP**: 8.1+
- **Frontend**: Bootstrap 5, Boxicons

## Fitur Utama

### Public Pages

- Beranda dengan informasi singkat
- Event & Turnamen
- Ranking Atlet
- Berita & Informasi
- Galeri Foto & Video
- Dokumen
- Pembinaan
- Live Scoring
- Hubungi Kami

### User Dashboard

- **Atlet**: Profil, Kartu Atlet, Daftar Turnamen, Riwayat Pertandingan, Ranking Pribadi
- **Pelatih**: Atlet Binaan, Sertifikasi, Profil
- **Klub**: Data Klub, Kelola Atlet, Kelola Pelatih, Pendaftaran Turnamen, Laporan Kegiatan, Statistik

### Admin Panel

- Manajemen Berita, Event, Atlet, Pelatih, Klub
- Pendaftaran (Atlet, Pelatih, Klub, Turnamen)
- Generate Pertandingan & Input Hasil
- Manajemen Ranking
- Analytics & Audit Log
- Manajemen Ofisial

## Setup & Installation

### 1. Clone Repository

```bash
git clone <repository-url>
cd ptmsi-sumbar
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
```

Edit `.env` dan sesuaikan konfigurasi database:

```
database.default.hostname = localhost
database.default.database = ptmsi_sumbar
database.default.username = root
database.default.password =
```

### 4. Generate App Key

```bash
php spark key:generate
```

### 5. Run Migrations

```bash
php spark migrate
```

### 6. Run Seeders (Optional)

```bash
php spark db:seed DokumenSeeder
php spark db:seed RatingSeeder
php spark db:seed NotificationSeeder
```

### 7. Start Development Server

```bash
php spark serve
```

Akses aplikasi di `http://localhost:8080`

## Default Credentials

- **Admin**: admin@ptmsi.id / admin123
- **Klub**: klub@ptmsi.id / klub123
- **Atlet**: atlet@ptmsi.id / atlet123
- **Pelatih**: pelatih@ptmsi.id / pelatih123

## Struktur Folder

```
ptmsi-sumbar/
├── app/
│   ├── Controllers/       # Controller aplikasi
│   ├── Models/           # Model database
│   ├── Views/            # Template view
│   ├── Database/         # Migrations & Seeds
│   ├── Filters/          # Authentication filters
│   ├── Helpers/          # Helper functions
│   └── Config/           # Konfigurasi
├── public/               # Public assets (CSS, JS, images)
├── system/               # CodeIgniter system files
├── writable/             # Writable directory (logs, cache)
├── composer.json         # Dependencies
└── spark                 # CLI tool
```

## Database Schema

Aplikasi menggunakan tabel-tabel berikut:

- `user` - Data pengguna
- `atlet` - Data atlet
- `pelatih` - Data pelatih
- `klub` - Data klub
- `event` - Data event/turnamen
- `ranking` - Data ranking atlet
- `hasil` - Hasil pertandingan
- `pendaftaran_atlet` - Pendaftaran atlet
- `pendaftaran_pelatih` - Pendaftaran pelatih
- `pendaftaran_event` - Pendaftaran event
- Dan tabel-tabel pendukung lainnya

## Fitur Keamanan

- Password hashing dengan bcrypt
- CSRF protection
- SQL injection prevention
- XSS protection
- Role-based access control (RBAC)
- Session management

## API Endpoints

Aplikasi menyediakan API endpoints untuk:

- Statistik atlet
- Data pertandingan event
- Standings/Klasemen
- Search atlet & event
- Ranking by kategori
- Top rated athletes

## Troubleshooting

### Server Crash

Jika server crash saat startup, pastikan:

1. Database sudah dibuat dan dikonfigurasi di `.env`
2. Semua migrations sudah dijalankan
3. Folder `writable/` memiliki permission 755

### Database Error

Jika ada error "Table doesn't exist":

1. Jalankan `php spark migrate` untuk membuat tabel
2. Jalankan `php spark db:seed` untuk data awal

### Permission Denied

Pastikan folder `writable/` dan `public/uploads/` memiliki permission write:

```bash
chmod -R 755 writable/
chmod -R 755 public/uploads/
```

## Support

Untuk pertanyaan atau masalah, hubungi tim development atau buka issue di repository.

---

**Versi**: 1.0.0  
**Last Updated**: December 24, 2025
