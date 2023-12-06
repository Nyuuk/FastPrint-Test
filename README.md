## Instalasi

### Pengantar
Dokumentasi ini memberikan panduan langkah demi langkah untuk menginstal dan menjalankan proyek Laravel. Anda dapat memilih antara instalasi dengan Docker atau menggunakan server PHP Artisan bawaan.

Project ini menggunakan Framework [Laravel](https://laravel.com/), [React Js](https://react.dev/), dan [TailwindCss](https://tailwindcss.com/)

### Persyaratan
Sebelum memulai, pastikan sistem Anda memenuhi persyaratan berikut:

- [Composer](https://getcomposer.org/) terinstal
- [Docker](https://www.docker.com/) terinstal (opsional, hanya jika Anda ingin menggunakan Docker)
- PHP 8.2 atau versi lebih tinggi terinstal
- [Node.js](https://nodejs.org/) terinstal
- [NPM](https://www.npmjs.com/) terinstal

### Instalasi dengan Docker (Opsional)
Jika Anda ingin menggunakan Docker, ikuti langkah-langkah berikut:

1. Clone repositori dari GitHub:
   ```bash
   git clone https://github.com/Nyuuk/FastPrint-Test/
   ```

2. Pindah ke direktori proyek:
   ```bash
   cd FastPrint-Test
   ```

3. Copy `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```

4. Buat container Docker dan jalankan proyek:
   ```bash
   docker-compose up -d
   ```

5. Masuk ke dalam container untuk menjalankan perintah artisan:
   ```bash
   docker-compose exec app bash
   ```

6. Install dependencies dan atur kunci aplikasi:
   ```bash
   docker-php-ext-install mysqli pdo pdo_mysql
   php artisan migrate
   php artisan key:generate
   ```

7. Keluar dari container:
   ```bash
   exit
   ```

8. Akses proyek di [http://localhost](http://localhost)

### Instalasi dengan PHP Artisan Serve (Di sarankan)
Pastikan untuk menginstall extensi `pdo`, `mysqli`

Jika Anda tidak menggunakan Docker, Anda dapat menggunakan PHP Artisan Serve:

1. Clone repositori dari GitHub:
   ```bash
   git clone https://github.com/nama-pengguna/ProyekLaravel.git
   ```

2. Pindah ke direktori proyek:
   ```bash
   cd FastPrint-Test
   ```

3. Copy `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```

4. Install dependencies dan atur kunci aplikasi:
   ```bash
   php artisan migrate
   php artisan key:generate
   ```

5. Jalankan server PHP Artisan:
   ```bash
   php artisan serve
   ```

6. Akses proyek di [http://localhost:8000](http://localhost:8000)

### Catatan
Pastikan untuk mengonfigurasi file `.env` sesuai dengan pengaturan database dan kebutuhan lainnya sebelum menjalankan perintah `php artisan migrate`.

![image](https://github.com/Nyuuk/FastPrint-Test/assets/76798963/5c9aef49-a303-4a70-8e80-7983abb1c0dc)
jika anda tidak melihat data yang harus di ambil dari [Api FastPrint](https://recruitment.fastprint.co.id/tes/programmer), maka anda harus mengklik *Refresh Produk*
