# 🧱 Base Projek CMS + API

**Base Projek CMS + API** adalah starter kit berbasis **Laravel 12** yang dilengkapi dengan **Filament Admin v3** untuk kebutuhan manajemen konten (CMS) serta menyediakan **API RESTful** yang siap pakai untuk pengembangan backend yang cepat dan efisien.

---

## 📝 Deskripsi

Proyek ini dirancang untuk mempercepat proses pembuatan backend aplikasi, terutama untuk kebutuhan:

- Manajemen konten melalui antarmuka admin (CMS)
- Integrasi API RESTful untuk aplikasi frontend (Web, Mobile, dll)
- Struktur kode yang rapi dan siap dikembangkan lebih lanjut

---

## ⚙️ Teknologi yang Digunakan

- PHP ^8.4
- Laravel ^12.0
- Filament ^3.3
- Laravel Tinker
- Autentikasi opsional (Sanctum / Passport)

---

## 🚀 Fitur Utama

- 🎛️ Dashboard Admin dengan Filament CMS
- 🔐 Dukungan autentikasi & middleware
- 📡 API RESTful modular dan scalable
- 📦 CRUD dinamis dari panel admin & endpoint API
- 🧪 Siap untuk penambahan unit dan feature test

---

## 📂 Struktur Proyek (Singkat)

```
routes/
├── api.php      → Endpoint RESTful
├── web.php      → Routing panel admin (Filament)

app/
├── Http/
│   ├── Controllers/ → API & Web Controllers
│   └── Resources/   → API Resource Wrappers
```

---

## 🛠️ Instalasi

```bash
# Clone repositori
git clone https://github.com/iqbalk96/Laravel-Base-Project.git
cd Laravel-Base-Project

# Install dependensi
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --seed

# Jalankan server lokal
php artisan serve
```

---

## 🔐 Akses Panel Admin

Setelah migrasi berhasil, akses admin panel:

```
http://localhost:8000/cms
```

Untuk membuat akun admin:

```bash
php artisan tinker
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
]);
```

> Pastikan user tersebut memiliki izin/role admin jika menggunakan sistem peran (role-based access).

---

## 📡 Dokumentasi API

Endpoint tersedia di bawah prefix `/api`.

Contoh endpoint dasar:

| Metode | URL Endpoint         | Deskripsi              |
|--------|----------------------|-------------------------|
| GET    | `/api/posts`         | Ambil semua data       |
| POST   | `/api/posts`         | Tambah data baru       |
| GET    | `/api/posts/{id}`    | Lihat detail data      |
| PUT    | `/api/posts/{id}`    | Perbarui data          |
| DELETE | `/api/posts/{id}`    | Hapus data             |

> Tambahkan autentikasi Sanctum/Passport jika dibutuhkan.

---

## Penting!

Proyek ini menggunakan **Rate Limiter** dan **Custom CORS** untuk keamanan API publik.

### 🔒 Rate Limiter
- Batas: 60 request per menit **per IP** **per endpoint**.
- Jika melebihi batas, API akan merespons dengan status `429 Too Many Requests`.

### 🌐 Custom CORS
- Hanya domain tertentu yang diizinkan melakukan request.
- Di environment `production`, request dari browser langsung akan **ditolak** jika bukan dari origin yang diizinkan.
- Di environment selain `production`, akses tetap dibuka untuk memudahkan pengembangan dan debugging.

Pastikan untuk mengatur `.env` sebagai berikut jika perlu override:

APP_ENV=production
ALLOW_PROD_API_DEBUG=false
ALLOWED_ORIGINS=http://localhost:5173,https://domainmu.com

---

---

## 🧪 Menjalankan Test

```bash
php artisan test
```

---

## 📄 Lisensi

Proyek ini dirilis di bawah lisensi MIT.

---

## 📚 Referensi

- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Laravel API Resources](https://laravel.com/docs/eloquent-resources)