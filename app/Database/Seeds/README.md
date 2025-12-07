# Database Seeders - PTMSI Sumbar

## Available Seeders

### 1. MasterSeeder (WAJIB DIJALANKAN PERTAMA)

Seeder utama yang harus dijalankan pertama kali karena membuat data dasar yang dibutuhkan seeder lainnya.

**Menambahkan:**

- 10 Users (1 admin, 6 atlet, 2 pelatih, 1 pengunjung)
- 3 Organisasi (1 provinsi, 2 kabupaten)
- 3 Klub
- 7 Atlet
- 2 Pelatih
- 3 Turnamen
- 2 Event

**Command:**

```bash
php spark db:seed MasterSeeder
```

### 2. RankingSeeder

Menambahkan data ranking, pertandingan, dan hasil.

**Requires:** MasterSeeder (minimal 5 atlet dan 2 event)

**Menambahkan:**

- Ranking untuk semua atlet
- Pertandingan (Final, Semi Final, Perempat Final)
- Hasil pertandingan

**Command:**

```bash
php spark db:seed RankingSeeder
```

### 3. BeritaSeeder

Menambahkan 5 artikel berita.

**Requires:** MasterSeeder (admin user)

**Menambahkan:**

- 5 Berita dengan berbagai kategori

**Command:**

```bash
php spark db:seed BeritaSeeder
```

### 4. DokumenSeeder

Menambahkan 15 dokumen.

**Requires:** MasterSeeder (admin user)

**Menambahkan:**

- 2 AD/ART
- 3 Peraturan Pertandingan
- 3 Panduan Klub
- 2 SOP Kejuaraan
- 5 Formulir

**Command:**

```bash
php spark db:seed DokumenSeeder
```

### 5. GaleriSeeder

Menambahkan 10 item galeri (foto dan video).

**Requires:** MasterSeeder (event data)

**Menambahkan:**

- 6 Foto kegiatan
- 4 Video highlight

**Command:**

```bash
php spark db:seed GaleriSeeder
```

### 6. LayananOnlineSeeder

Menambahkan data pendaftaran event dan pesan kontak.

**Requires:** MasterSeeder (atlet dan event data)

**Menambahkan:**

- 3 Pendaftaran event
- 5 Pesan kontak

**Command:**

```bash
php spark db:seed LayananOnlineSeeder
```

## Urutan Menjalankan Seeder

**PENTING:** Jalankan seeder dalam urutan berikut:

```bash
# 1. WAJIB - Jalankan pertama kali
php spark db:seed MasterSeeder

# 2. Jalankan seeder lainnya (urutan bebas)
php spark db:seed RankingSeeder
php spark db:seed BeritaSeeder
php spark db:seed DokumenSeeder
php spark db:seed GaleriSeeder
php spark db:seed LayananOnlineSeeder
```

## Menjalankan Semua Seeder Sekaligus

Anda bisa membuat seeder baru yang memanggil semua seeder:

```php
<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('MasterSeeder');
        $this->call('RankingSeeder');
        $this->call('BeritaSeeder');
        $this->call('DokumenSeeder');
        $this->call('GaleriSeeder');
        $this->call('LayananOnlineSeeder');
    }
}
```

Kemudian jalankan:

```bash
php spark db:seed DatabaseSeeder
```

## Reset Database

Untuk mereset database dan menjalankan ulang seeder:

```bash
# Drop semua tabel dan buat ulang
php spark migrate:refresh

# Jalankan seeder
php spark db:seed MasterSeeder
php spark db:seed RankingSeeder
php spark db:seed BeritaSeeder
php spark db:seed DokumenSeeder
php spark db:seed GaleriSeeder
php spark db:seed LayananOnlineSeeder
```

## Login Credentials

Setelah menjalankan MasterSeeder, gunakan kredensial berikut untuk login:

**Admin:**

- Username: `admin`
- Password: `admin123`
- Email: `admin@ptmsisumbar.or.id`

**Atlet:**

- Username: `ahmad_fauzi`, `siti_rahma`, `budi_santoso`, dll
- Password: `password123`

## Notes

- Semua seeder memiliki error handling untuk data yang tidak lengkap
- UUID digunakan untuk id_user (CHAR 36)
- Auto-increment digunakan untuk tabel lainnya
- Tanggal menggunakan format Y-m-d H:i:s
- Status default: 'aktif', 'published', 'dibuka', dll
