# SOBAT-PS - Sistem Informasi Pemberdayaan Masyarakat dan Perhutanan Sosial

![laravel](https://img.shields.io/badge/laravel-v10.18.0-blue)
![dependencies](https://img.shields.io/badge/dependencies-up%20to%20date-brightgreen)

Sebuah sistem informasi pemberdayaan kehutanan yang dikembangkan oleh Dinas Kehutanan Provinsi Kalimantan Utara.

## Features

-   Daftar Lembaga PS dan Lembaga KUPS beserta detail informasi terkait.
-   Daftar program yang disediakan oleh Dinas Kehutanan.
-   Daftar penerima hibah bantuan dari Dinas Kehutanan.
-   Daftar usulan bantuan yang telah diajukan oleh anggota KUPS beserta rinciannya.

## Prerequisites

Sebelum Anda memulai, pastikan Anda sudah menginstal semua prasyarat berikut:

-   [PHP](https://www.php.net/) v8.1.6
-   [Composer](https://getcomposer.org/)
-   [Laravel](https://laravel.com/) v10.18.0

## Installation

1. Clone repositori ini:

```bash
  git clone https://github.com/besarrahmat/sobatps.git
  cd sobatps
```

2. Instal dependensi PHP:

```bash
  composer install
```

3. Salin file `.env.example` ke `.env` dan sesuaikan pengaturan database serta konfigurasi lainnya:

```bash
  cp .env.example .env
```

4. Generate kunci aplikasi:

```bash
  php artisan key:generate
```

5. Jalankan migrasi database:

```bash
  php artisan migrate
```

6. Jalankan agar file dapat diakses oleh publik:

```bash
  php artisan storage:link
```

7. Jalankan server lokal:

```bash
  php artisan serve
```

SOBAT-PS sekarang berjalan pada http://localhost:8000.

## License

Proyek ini dilensikan di bawah [MIT License](https://choosealicense.com/licenses/mit/)

## Authors

-   Dinas Kehutanan Provinsi Kalimantan Utara
-   [@besarrahmat](https://www.github.com/besarrahmat)
