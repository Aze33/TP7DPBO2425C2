<?php
class Film {
    private $conn;
    private $table_name = "tbl_film";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk menambahkan film baru (INSERT)
    public function create($judul, $tahun, $durasi, $rating, $id_genre, $id_sutradara) {
        $query = "INSERT INTO " . $this->table_name . 
                 " (judul_film, tahun_rilis, durasi_menit, rating_usia, id_genre, id_sutradara) 
                 VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        $id_genre = $id_genre == 0 ? null : $id_genre;
        $id_sutradara = $id_sutradara == 0 ? null : $id_sutradara;
        
        return $stmt->execute([$judul, $tahun, $durasi, $rating, $id_genre, $id_sutradara]);
    }

    public function read() {
        $query = "SELECT f.id_film, f.judul_film, f.tahun_rilis, f.durasi_menit, f.rating_usia, 
                         g.nama_genre, s.nama_sutradara 
                  FROM " . $this->table_name . " f
                  LEFT JOIN tbl_genre g ON f.id_genre = g.id_genre
                  LEFT JOIN tbl_sutradara s ON f.id_sutradara = s.id_sutradara";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_film = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk memperbarui data film (UPDATE)
    public function update($id, $judul, $tahun, $durasi, $rating, $id_genre, $id_sutradara) {
        $query = "UPDATE " . $this->table_name . 
                 " SET judul_film = ?, tahun_rilis = ?, durasi_menit = ?, rating_usia = ?, 
                       id_genre = ?, id_sutradara = ? 
                 WHERE id_film = ?";
        $stmt = $this->conn->prepare($query);
        
        $id_genre = $id_genre == 0 ? null : $id_genre;
        $id_sutradara = $id_sutradara == 0 ? null : $id_sutradara;
        
        return $stmt->execute([$judul, $tahun, $durasi, $rating, $id_genre, $id_sutradara, $id]);
    }

    // Fungsi untuk menghapus data film (DELETE)
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_film = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>