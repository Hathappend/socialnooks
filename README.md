# SocialNooks

## Deskripsi Umum
SocialNooks adalah aplikasi berbasis web yang membantu pengguna menemukan tempat hangout atau bekerja yang sesuai dengan preferensi mereka. Aplikasi ini menyediakan informasi tentang berbagai tempat seperti kafe, co-working space, dan lokasi publik lainnya berdasarkan lokasi pengguna dan kategori tempat.

Aplikasi ini dikembangkan menggunakan **Laravel**, **Laravel Livewire** untuk interaksi real-time, serta **Filament** sebagai manajemen backend/admin panel. Data tempat berasal dari **Google Places API** dan kontribusi pengguna yang telah diverifikasi oleh administrator.

## Fitur Utama
- **Pencarian Tempat** berdasarkan kata kunci, kategori, dan lokasi pengguna.
- **Rekomendasi Tempat** dengan informasi lengkap seperti alamat, rating, ulasan, dan foto.
- **Integrasi Google Maps** untuk menampilkan lokasi secara interaktif.
- **Kontribusi Pengguna** dengan kemampuan menambahkan tempat baru ke dalam database.
- **Sistem Validasi** oleh administrator sebelum tempat tampil di hasil pencarian.
- **Review dan Rating** dari pengguna untuk membantu pengambilan keputusan.
- **Manajemen Admin** menggunakan Filament untuk validasi tempat dan pengelolaan data.

## Teknologi yang Digunakan
- **Backend**: Laravel
- **Frontend**: Laravel Livewire
- **Database**: MySQL
- **Admin Panel**: Filament
- **API Eksternal**: Google Places API
- **Pemetaan**: Google Maps API

## Batasan Sistem
1. SocialNooks hanya memberikan informasi dan rekomendasi tempat, **tidak menyediakan fitur pemesanan atau reservasi**.
2. Data tempat berasal dari **Google Places API dan kontribusi pengguna**, sehingga beberapa lokasi mungkin tidak terdaftar.
3. **Pengguna hanya dapat menambahkan tempat**, belum bisa mengedit atau memberikan koreksi terhadap tempat yang sudah ada.
4. **Jumlah hasil pencarian dibatasi** untuk mengoptimalkan performa aplikasi.
5. **Akses ke panel administrasi Filament dibatasi hanya untuk administrator**.

## Instalasi dan Konfigurasi
### Prasyarat
Sebelum menginstal SocialNooks, pastikan perangkat telah menginstal:
- PHP ^8.1
- Composer
- Node.js & NPM
- MySQL
- Laravel 11

### Langkah Instalasi
1. Clone repository ini:
   ```sh
   git clone https://github.com/Hathappend/socialnooks.git
   ```
2. Masuk ke direktori proyek:
   ```sh
   cd socialnooks
   ```
3. Instal dependensi Laravel:
   ```sh
   composer install
   ```
4. Instal dependensi frontend:
   ```sh
   npm install && npm run dev
   ```
5. Salin file konfigurasi `.env`:
   ```sh
   cp .env.example .env
   ```
6. Atur konfigurasi database di file `.env`:
   ```env
   DB_DATABASE=socialnooks
   DB_USERNAME=root
   DB_PASSWORD=
   ```
7. Jalankan migrasi database:
   ```sh
   php artisan migrate --seed
   ```
8. Generate application key:
   ```sh
   php artisan key:generate
   ```
9. Jalankan server lokal:
   ```sh
   php artisan serve
   ```
10. Akses aplikasi di browser: `http://127.0.0.1:8000`

## Penggunaan
- **Cari tempat** berdasarkan kategori atau lokasi.
- **Tambahkan tempat** yang belum tersedia di sistem.
- **Berikan review dan rating** untuk tempat yang telah dikunjungi.
- **Gunakan fitur peta interaktif** untuk menavigasi lokasi.

## Kontribusi
Jika ingin berkontribusi dalam pengembangan SocialNooks, silakan fork repository ini dan kirimkan pull request.


---
🚀 *Temukan tempat terbaik untuk bekerja atau bersantai dengan SocialNooks!*
