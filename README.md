# Janji

Saya Zahran Zaidan Saputra dengan NIM 2415429 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# 🎞️ Sistem Katalog Movie Berbasis OOP

Project ini merupakan tugas praktikum yang mengimplementasikan konsep Object-Oriented Programming (OOP) dalam Website berbasis PHP dengan GUI Web.Aplikasi ini menampilkan sistem **Katalog Movie** untuk mengelola **film**, **genre**, dan **sutradara** dengan fitur CRUD (Create, Read, Update, Delete) serta **relasi antar 3 tabel** menggunakan MySQL Database.

# 🎥 Tema Website : Katalog Movie

Tema website ini adalah **"Katalog Movie"**. Sederhananya, ini adalah halaman admin untuk mengelola koleksi film. Admin yang menggunakan website ini bisa:

* **Menambah** data film, genre, dan sutradara baru.
* **Melihat** semua data yang sudah tersimpan.
* **Mengubah** data jika ada yang salah (Update).
* **Menghapus** data yang sudah tidak dipakai.

# 📼 Struktur Database Tabel

**1. Tabel `genre`**
| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id_genre` | INT (PK, AUTO_INCREMENT) | ID unik untuk genre |
| `nama_genre` | VARCHAR(50) | Nama genre (misal: Action, Sci-Fi) |

**2. Tabel `sutradara`**
| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id_sutradara` | INT (PK, AUTO_INCREMENT) | ID unik untuk sutradara |
| `nama_sutradara` | VARCHAR(100) | Nama sutradara |
| `negara_asal` | VARCHAR(50) | Negara asal sutradara |

**3. Tabel `film`**
| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id_film` | INT (PK, AUTO_INCREMENT) | ID unik untuk film |
| `judul_film` | VARCHAR(150) | Judul film |
| `tahun_rilis` | INT(4) | Tahun rilis |
| `durasi_menit` | INT(11) | Durasi film dalam menit |
| `rating_usia` | VARCHAR(5) | Rating usia (misal: PG-13) |
| `id_genre` | INT (FK &rarr; genre.id_genre) | Relasi ke tabel genre |
| `id_sutradara` | INT (FK &rarr; sutradara.id_sutradara) | Relasi ke tabel sutradara |

# Struktur Folder Proyek

<img width="549" height="603" alt="image" src="https://github.com/user-attachments/assets/f153191a-ba83-4c4f-989e-82513d0a9103" />

# Alur Program (Flow Kode)

Berikut adalah alur program dan fungsionalitas dari setiap halaman:

**1. Halaman Utama (`index.php`)**
* Bertindak sebagai *router* atau file utama yang dipanggil.
* Menampilkan `header.php`, `menu.php`, dan `footer.php`.
* Meng-`include` (memuat) file halaman dari folder `view/` sesuai dengan parameter `$_GET['page']` (contoh: `index.php?page=film` akan memuat `view/film.php`).
* Jika `page` tidak ada, `view/home.php` (Dashboard) akan dimuat sebagai *default*.

**2. CRUD Genre (`view/genre.php`)**
* **Create:** Menampilkan form tambah genre baru. Saat disubmit, memanggil `create()` dari `class/Genre.php`.
* **Read:** Menampilkan data dari `tbl_genre` ke dalam tabel HTML.
* **Update:** Menampilkan form edit genre. Saat disubmit, memanggil `update()` dari `class/Genre.php`.
* **Delete:** Menyediakan tombol hapus. Saat diklik, memanggil `delete()` dari `class/Genre.php`.

**3. CRUD Sutradara (`view/sutradara.php`)**
* **Create:** Menampilkan form tambah sutradara baru. Memanggil `create()` dari `class/Sutradara.php`.
* **Read:** Menampilkan data dari `tbl_sutradara` ke dalam tabel HTML.
* **Update:** Menampilkan form edit sutradara. Memanggil `update()` dari `class/Sutradara.php`.
* **Delete:** Menyediakan tombol hapus. Memanggil `delete()` dari `class/Sutradara.php`.

**4. CRUD Film (`view/film.php`)**
* **Create:** Menampilkan form tambah film baru. Form ini memiliki *dropdown* yang mengambil data dari `tbl_genre` dan `tbl_sutradara`. Saat disubmit, memanggil `create()` dari `class/Film.php`.
* **Read:** Menampilkan data dari `tbl_film` ke dalam tabel HTML. Data `id_genre` dan `id_sutradara` ditampilkan sebagai nama (hasil `JOIN` dari *class*).
* **Update:** Menampilkan form edit film. Memanggil `update()` dari `class/Film.php`.
* **Delete:** Menyediakan tombol hapus. Memanggil `delete()` dari `class/Film.php`.

# Dokumentasi

https://github.com/user-attachments/assets/c1567da5-f886-4f42-829b-8de11d093e18





