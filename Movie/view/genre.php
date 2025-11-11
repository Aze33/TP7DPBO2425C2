<?php
include_once 'config/Database.php';
include_once 'class/Genre.php';

$database = new Database();
$db = $database->getConnection();
$genre = new Genre($db);

// Logika CRUD
$action = isset($_POST['action']) ? $_POST['action'] : '';
$edit_id = isset($_GET['edit_id']) ? $_GET['edit_id'] : '';
$data_edit = null;

if ($action == 'create') {
    $genre->create($_POST['nama_genre']);
    header("Location: index.php?page=genre");
}
if ($action == 'update') {
    $genre->update($_POST['id_genre'], $_POST['nama_genre']);
    header("Location: index.php?page=genre");
}
if (isset($_GET['delete_id'])) {
    $genre->delete($_GET['delete_id']);
    header("Location: index.php?page=genre");
}
if ($edit_id) {
    $data_edit = $genre->readOne($edit_id);
}
$stmt = $genre->read();
?>
<div class="content">
    <h2>Data Genre</h2>
    <h3><?php echo $edit_id ? 'Edit' : 'Tambah'; ?> Genre</h3>
    <form action="index.php?page=genre" method="POST">
        <?php if ($edit_id): ?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id_genre" value="<?php echo $data_edit['id_genre']; ?>">
        <?php else: ?>
            <input type="hidden" name="action" value="create">
        <?php endif; ?>
        <label>Nama Genre:</label>
        <input type="text" name="nama_genre" value="<?php echo $edit_id ? $data_edit['nama_genre'] : ''; ?>" required>
        <button type="submit"><?php echo $edit_id ? 'Update' : 'Simpan'; ?></button>
    </form>
    <hr>
    <h3>Daftar Genre</h3>
    <table>
        <thead> <tr> <th>ID</th> <th>Nama Genre</th> <th>Aksi</th> </tr> </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): extract($row); ?>
            <tr>
                <td><?php echo $id_genre; ?></td>
                <td><?php echo $nama_genre; ?></td>
                <td>
                    <a href='index.php?page=genre&edit_id=<?php echo $id_genre; ?>' class='btn-edit'>Edit</a>
                    <a href='index.php?page=genre&delete_id=<?php echo $id_genre; ?>' onclick='return confirm("Yakin?")' class='btn-delete'>Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>