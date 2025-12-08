# Admin Panel PTMSI Sumbar

Admin panel yang terintegrasi dengan template Sneat untuk mengelola website PTMSI Sumatera Barat.

## 🎯 Fitur yang Sudah Dibuat

### 1. **Layout & Template**

- ✅ Main Layout (`app/Views/admin/layouts/main.php`)
- ✅ Sidebar Navigation (`app/Views/admin/layouts/sidebar.php`)
- ✅ Header/Navbar (`app/Views/admin/layouts/header.php`)
- ✅ Footer (`app/Views/admin/layouts/footer.php`)
- ✅ Menggunakan template Sneat (Bootstrap 5)

### 2. **Dashboard**

- ✅ Controller: `app/Controllers/Admin/Dashboard.php`
- ✅ View: `app/Views/admin/dashboard/index.php`
- ✅ Statistik Cards (Total Atlet, Pelatih, Klub, Event)
- ✅ Berita Terbaru
- ✅ Event Mendatang
- ✅ Pendaftaran Pending

### 3. **Manajemen Berita (CRUD Lengkap)**

- ✅ Controller: `app/Controllers/Admin/Berita.php`
- ✅ View List: `app/Views/admin/berita/index.php`
- ✅ Fitur: Create, Read, Update, Delete
- ✅ Upload gambar
- ✅ Search & Filter

### 4. **Authentication & Security**

- ✅ Admin Filter: `app/Filters/AdminFilter.php`
- ✅ Role-based access control
- ✅ Auto redirect ke dashboard setelah login (untuk admin)
- ✅ Session management

### 5. **Routes**

- ✅ Admin routes group dengan namespace
- ✅ Protected routes untuk semua halaman admin
- ✅ RESTful routing pattern

## 📁 Struktur Folder

```
app/
├── Controllers/
│   └── Admin/
│       ├── Dashboard.php       ✅ Sudah dibuat
│       └── Berita.php          ✅ Sudah dibuat
├── Filters/
│   └── AdminFilter.php         ✅ Sudah dibuat
├── Views/
│   └── admin/
│       ├── layouts/
│       │   ├── main.php        ✅ Sudah dibuat
│       │   ├── sidebar.php     ✅ Sudah dibuat
│       │   ├── header.php      ✅ Sudah dibuat
│       │   └── footer.php      ✅ Sudah dibuat
│       ├── dashboard/
│       │   └── index.php       ✅ Sudah dibuat
│       └── berita/
│           └── index.php       ✅ Sudah dibuat
```

## 🚀 Cara Mengakses Admin Panel

### 1. Login sebagai Admin

```
URL: http://localhost/login
Username: admin
Password: admin123
```

### 2. Akses Dashboard

```
URL: http://localhost/admin/dashboard
atau
URL: http://localhost/admin
```

### 3. Menu yang Tersedia

- **Dashboard** - Statistik dan overview
- **Manajemen Konten**
  - Berita ✅ (Sudah lengkap)
  - Event (Routes sudah ada, controller & view belum)
  - Galeri (Routes sudah ada, controller & view belum)
  - Dokumen (Routes sudah ada, controller & view belum)
- **Manajemen Data**
  - Atlet (Routes sudah ada, controller & view belum)
  - Pelatih (Routes sudah ada, controller & view belum)
  - Klub (Routes sudah ada, controller & view belum)
  - Pengurus (Routes sudah ada, controller & view belum)
- **Layanan**
  - Pendaftaran (Routes sudah ada, controller & view belum)
  - Sertifikasi (Routes sudah ada, controller & view belum)
  - Pesan Kontak (Routes sudah ada, controller & view belum)
- **Sistem**
  - Users (Routes sudah ada, controller & view belum)
  - Pengaturan (Routes sudah ada, controller & view belum)

## 🎨 Design System

### Warna

- Primary: `#696cff` (Sneat default)
- Success: `#71dd37`
- Warning: `#ffab00`
- Danger: `#ff3e1d`
- Info: `#03c3ec`

### Komponen

- Cards dengan shadow
- Dropdown menu untuk actions
- Badge untuk status
- Avatar untuk user
- Notification dropdown
- Quick links dropdown

## 📝 Cara Menambah Module Baru

### Contoh: Membuat CRUD Event

1. **Buat Controller**

```php
// app/Controllers/Admin/Event.php
<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EventModel;

class Event extends BaseController
{
    // Constructor dengan auth check
    // index(), create(), store(), edit(), update(), delete()
}
```

2. **Buat View**

```php
// app/Views/admin/event/index.php
<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
// Content here
<?= $this->endSection() ?>
```

3. **Routes sudah ada** di `app/Config/Routes.php`

## 🔒 Security Features

1. **Authentication Check**

   - Setiap controller admin mengecek login status
   - Redirect ke login jika belum login

2. **Role-based Access**

   - Hanya user dengan role 'admin' yang bisa akses
   - Redirect ke home jika bukan admin

3. **CSRF Protection**

   - Semua form menggunakan `<?= csrf_field() ?>`

4. **File Upload Validation**
   - Validasi tipe file
   - Random filename untuk security

## 📊 Database Models yang Digunakan

- ✅ `UserModel` - Manajemen user
- ✅ `BeritaModel` - Manajemen berita
- ✅ `EventModel` - Manajemen event
- ✅ `AtletModel` - Manajemen atlet
- ✅ `PelatihModel` - Manajemen pelatih
- ✅ `KlubModel` - Manajemen klub

## 🎯 Next Steps (Yang Perlu Dibuat)

1. **CRUD Controllers & Views untuk:**

   - Event (create, edit views)
   - Atlet (semua views)
   - Pelatih (semua views)
   - Klub (semua views)
   - Pengurus (semua views)
   - Galeri (semua views)
   - Dokumen (semua views)
   - Users (semua views)
   - Settings (semua views)

2. **Fitur Tambahan:**

   - Pagination untuk list data
   - Advanced search & filter
   - Export data (Excel, PDF)
   - Bulk actions
   - Image cropper untuk upload
   - Rich text editor (TinyMCE/CKEditor)
   - Activity log
   - Notification system

3. **Dashboard Enhancements:**
   - Charts (ApexCharts sudah include)
   - Real-time statistics
   - Recent activities
   - Quick actions

## 💡 Tips Development

1. **Extend Layout**

   ```php
   <?= $this->extend('admin/layouts/main') ?>
   ```

2. **Set Title**

   ```php
   $data['title'] = 'Judul Halaman';
   ```

3. **Flash Messages**

   ```php
   return redirect()->to('admin/berita')
       ->with('success', 'Berhasil!');
   ```

4. **Auth Check di Constructor**
   ```php
   if (!session()->get('logged_in')) {
       redirect()->to('auth/login')->send();
       exit;
   }
   ```

## 📞 Support

Jika ada pertanyaan atau butuh bantuan development, silakan tanyakan!

---

**Status:** ✅ Admin Panel Foundation Complete
**Template:** Sneat Bootstrap 5
**Framework:** CodeIgniter 4
**Last Updated:** <?= date('d M Y') ?>
