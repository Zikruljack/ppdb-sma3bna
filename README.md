# PPDB Online - Laravel Application

## 📌 Deskripsi

Aplikasi **PPDB Online** berbasis Laravel yang mendukung berbagai jalur penerimaan seperti **zonasi, afirmasi, dan prestasi**.
Aplikasi ini menggunakan **notifikasi berbasis database & email**, serta menangani **error secara custom**.

---

## 🛠️ Teknologi yang Digunakan

- **Laravel** (Framework PHP)
- **NodeJS** (NodeJs)
- **MySQL** (Database Management)
- **Redis** (Queue & Cache)
- **Nginx/Apache** (Web Server)
- **Supervisor/Cron Job** (Queue Worker Management)
- **Bootstrap** (Frontend Styling)
- **AdminLTE3** (Frontend Template Styling)

---

## 🚀 Instalasi dan Konfigurasi

### 1️⃣ **Clone Repository & Instalasi Dependensi**

```bash
git clone https://github.com/Zikruljack/ppdb-laravel.git
cd ppdb-laravel
composer install
cp .env.example .env
php artisan key:generate
```

### 2️⃣ **Konfigurasi `.env`**

Ubah konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppdb_db
DB_USERNAME=root
DB_PASSWORD=
```

Untuk **email & notifikasi**:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=youremail@gmail.com
MAIL_PASSWORD=yourpassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=youremail@gmail.com
MAIL_FROM_NAME="PPDB Online"
```

### 3️⃣ **Migrasi Database**

```bash
php artisan migrate --seed
```

### 4️⃣ **Jalankan Server Lokal**

```bash
npm run dev #ini untuk jalanin dev bersamaan start server laravel
npm run build #ini untuk build hasil vite
php artisan serve
```

---

## ⚙️ Konfigurasi Nginx

Jika menggunakan **Nginx**, edit file konfigurasi Nginx:

```bash
sudo nano /etc/nginx/sites-available/ppdb-online
```

Tambahkan konfigurasi berikut:

```nginx
server {
    listen 80;
    server_name ppdb-online.local;
    root /var/www/ppdb-laravel/public;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

### 5️⃣ **Aktifkan Konfigurasi Nginx & Restart**

```bash
sudo ln -s /etc/nginx/sites-available/ppdb-online /etc/nginx/sites-enabled/
sudo systemctl restart nginx
```

---

## 🖥️ Deploy Laravel di cPanel (Apache)

Jika menggunakan **cPanel (Apache)**, ikuti langkah berikut:

### **1️⃣ Upload Laravel ke cPanel**

1. **Buka File Manager** di cPanel.
2. Masuk ke folder **`public_html`**, lalu buat folder baru, misalnya `ppdb-online`.
3. **Upload file ZIP** proyek Laravel ke dalam folder tersebut.
4. **Ekstrak file ZIP** dan pastikan struktur foldernya benar.

### **2️⃣ Konfigurasi Folder Public**

1. Masuk ke **File Manager** di cPanel.
2. **Pindahkan semua file** dalam `public_html` ke folder Laravel kecuali `.htaccess` jika ada.
3. **Edit file `.htaccess` di `public_html`**, lalu tambahkan:

```apache
RewriteEngine On
RewriteRule ^(.*)$ public/$1 [L]
```

4. **Simpan perubahan**.

### **3️⃣ Konfigurasi `.env`**

Pastikan `.env` sudah sesuai dengan konfigurasi database dan email di cPanel.

### **4️⃣ Setting Permission Folder Storage & Bootstrap**

```bash
chmod -R 775 storage bootstrap/cache
```

Jika ada masalah akses, gunakan:

```bash
chmod -R 777 storage bootstrap/cache
```

### **5️⃣ Setup Cron Job untuk Queue**

1. Buka **cPanel > Cron Jobs**.
2. Tambahkan Cron Job baru:

```bash
php /home/your_user/ppdb-online/artisan schedule:run >> /dev/null 2>&1
```

3. Set waktu eksekusi **setiap 1 menit** (`* * * * *`).

Untuk Queue:

```bash
php /home/your_user/ppdb-online/artisan queue:work --tries=3
```

### **6️⃣ Konfigurasi SSL (Opsional)**

Pastikan di `.env` kamu menggunakan **HTTPS** jika SSL aktif:

```env
APP_URL=https://yourdomain.com
```

Jika belum memiliki SSL, aktifkan melalui **cPanel > SSL/TLS Status > Run AutoSSL**.

---

## 📨 Notifikasi dengan Queue & Supervisor

Aplikasi ini menggunakan **queue** untuk notifikasi. Jalankan perintah berikut:

```bash
php artisan queue:work --daemon
```

Untuk menjalankan queue secara otomatis di **server (Nginx)**, gunakan **Supervisor**:

```bash
sudo nano /etc/supervisor/conf.d/ppdb-worker.conf
```

Tambahkan konfigurasi berikut:

```conf
[program:ppdb-worker]
process_name=%(program_name)s
command=php /var/www/ppdb-laravel/artisan queue:work --tries=3
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/log/supervisor/ppdb-worker.log
```

Jalankan Supervisor:

```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start ppdb-worker
```

Jika menggunakan **cPanel**, gunakan **Cron Job** untuk queue.

---

## 🎯 Custom Error Handling

Jika terjadi error, aplikasi akan melempar ke halaman custom:

- **404.blade.php** → Halaman tidak ditemukan
- **500.blade.php** → Kesalahan server
- **403.blade.php** → Akses ditolak

---

## 📌 Fitur Utama

✅ **Pendaftaran Multi-Jalur**: Zonasi, Afirmasi, Prestasi  
✅ **Validasi Dokumen**: Otomatis memeriksa file yang diunggah  
✅ **Notifikasi**: Email + Database Notification  
✅ **Optimasi Performance**: Queue & Caching  
✅ **Custom Error Handling**

---

## 👥 Kontributor

- **Muhammad Zikrullah** (Developer)  

Jika ada pertanyaan, silakan hubungi [matakaca.mz30@gmail.com](mailto:matakaca.mz30@gmail.com).
