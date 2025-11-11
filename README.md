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

# Dokumentasi

https://github.com/user-attachments/assets/c1567da5-f886-4f42-829b-8de11d093e18





