<?php
class Genre {
    private $conn;
    private $table_name = "tbl_genre";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk menambahkan genre baru (INSERT)
    public function create($nama_genre) {
        $query = "INSERT INTO " . $this->table_name . " (nama_genre) VALUES (?)";
        $stmt = $this->conn->prepare($query); 
        return $stmt->execute([$nama_genre]);
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_genre = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk memperbarui data genre (UPDATE)
    public function update($id, $nama_genre) {
        $query = "UPDATE " . $this->table_name . " SET nama_genre = ? WHERE id_genre = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama_genre, $id]);
    }

    // Fungsi untuk menghapus data genre (DELETE)
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_genre = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>