<?php
class Sutradara {
    private $conn;
    private $table_name = "tbl_sutradara";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk menambahkan sutradara baru (INSERT)
    public function create($nama, $negara) {
        $query = "INSERT INTO " . $this->table_name . " (nama_sutradara, negara_asal) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama, $negara]);
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_sutradara = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk memperbarui data sutradara (UPDATE)
    public function update($id, $nama, $negara) {
        $query = "UPDATE " . $this->table_name . " SET nama_sutradara = ?, negara_asal = ? WHERE id_sutradara = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama, $negara, $id]);
    }

    // Fungsi untuk menghapus data sutradara (DELETE)
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_sutradara = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>