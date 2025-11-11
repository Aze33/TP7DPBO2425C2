<?php
include_once 'config/Database.php';
include_once 'class/Sutradara.php';

$database = new Database();
$db = $database->getConnection();
$sutradara = new Sutradara($db);

// Logika CRUD
$action = isset($_POST['action']) ? $_POST['action'] : '';
$edit_id = isset($_GET['edit_id']) ? $_GET['edit_id'] : '';
$data_edit = null;

if ($action == 'create') {
    $sutradara->create($_POST['nama_sutradara'], $_POST['negara_asal']);
    header("Location: index.php?page=sutradara");
}
if ($action == 'update') {
    $sutradara->update($_POST['id_sutradara'], $_POST['nama_sutradara'], $_POST['negara_asal']);
    header("Location: index.php?page=sutradara");
}
if (isset($_GET['delete_id'])) {
    $sutradara->delete($_GET['delete_id']);
    header("Location: index.php?page=sutradara");
}
if ($edit_id) {
    $data_edit = $sutradara->readOne($edit_id);
}
$stmt = $sutradara->read();
?>
<div class="content">
    <h2>Data Sutradara</h2>
    <h3><?php echo $edit_id ? 'Edit' : 'Tambah'; ?> Sutradara</h3>
    <form action="index.php?page=sutradara" method="POST">
        <?php if ($edit_id): ?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id_sutradara" value="<?php echo $data_edit['id_sutradara']; ?>">
        <?php else: ?>
            <input type="hidden" name="action" value="create">
        <?php endif; ?>
        <label>Nama Sutradara:</label>
        <input type="text" name="nama_sutradara" value="<?php echo $edit_id ? $data_edit['nama_sutradara'] : ''; ?>" required>
        <label>Negara Asal:</label>
        <input type="text" name="negara_asal" value="<?php echo $edit_id ? $data_edit['negara_asal'] : ''; ?>">
        <button type="submit"><?php echo $edit_id ? 'Update' : 'Simpan'; ?></button>
    </form>
    <hr>
    <h3>Daftar Sutradara</h3>
    <table>
        <thead> <tr> <th>ID</th> <th>Nama</th> <th>Negara Asal</th> <th>Aksi</th> </tr> </thead>
        <tbody>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): extract($row); ?>
            <tr>
                <td><?php echo $id_sutradara; ?></td>
                <td><?php echo $nama_sutradara; ?></td>
                <td><?php echo $negara_asal; ?></td>
                <td>
                    <a href='index.php?page=sutradara&edit_id=<?php echo $id_sutradara; ?>' class='btn-edit'>Edit</a>
                    <a href='index.php?page=sutradara&delete_id=<?php echo $id_sutradara; ?>' onclick='return confirm("Yakin?")' class='btn-delete'>Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>