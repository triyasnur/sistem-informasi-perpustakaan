# 📚 Sistem Informasi Perpustakaan

Sistem Informasi Perpustakaan berbasis Laravel untuk mengelola data buku secara digital.  
Aplikasi ini dibuat sebagai project kelompok dengan fitur CRUD dan autentikasi pengguna.

---
## 👥 Anggota Tim

Project ini dikerjakan secara kelompok:

- Ketua: Triyas Nurlita Nurul Adha  
- Anggota 1: (Nama teman kamu 1)  
- Anggota 2: (Nama teman kamu 2)  
- Anggota 3: (jika ada)


## 🚀 Fitur Utama

### 🔐 Autentikasi
- Login user
- Register user
- Forgot password / reset password
- Logout

---

### 📚 Manajemen Buku (CRUD)
- Tambah data buku
- Lihat daftar buku
- Edit data buku
- Hapus data buku
- Detail buku
- Pencarian buku
- Filter kategori buku

---

### 📊 Dashboard
- Total koleksi buku
- Buku terbaru (card warna-warni)
- Distribusi kategori buku (progress bar)
- Tampilan modern dengan Tailwind CSS

---

### 🧭 Sidebar Menu
- 🏠 Dashboard  
- 📚 Data Buku (CRUD)  
- 👤 Profile User  
- 🔐 Logout  

Sidebar dibuat responsif dan mudah digunakan.

---

## 🖥️ Tampilan Aplikasi

### Dashboard
- Statistik jumlah buku
- Buku terbaru dengan cover warna-warni
- Grafik kategori buku

### Data Buku
- Tabel data buku lengkap
- Fitur search & filter
- Action: Detail, Edit, Hapus

---

## 🛠️ Teknologi yang Digunakan

- Laravel 11
- PHP 8+
- MySQL
- Tailwind CSS
- Vite
- Blade Template

---

## ⚙️ Cara Instalasi

```bash
git clone https://github.com/triyasnur/sistem-informasi-perpustakaan.git
cd sistem-informasi-perpustakaan

composer install
npm install
npm run dev

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

php artisan serve