<?php
include_once 'config/Database.php';
include_once 'class/Film.php';
include_once 'class/Genre.php';
include_once 'class/Sutradara.php';

// Helper function untuk konversi durasi
function konversiDurasi($menit) {
    if ($menit < 1 || !is_numeric($menit)) return "-";
    $jam = floor($menit / 60);
    $sisaMenit = $menit % 60;
    $hasil = "";
    if ($jam > 0) $hasil .= $jam . " jam ";
    if ($sisaMenit > 0) $hasil .= $sisaMenit . " menit";
    return trim($hasil);
}

$database = new Database();
$db = $database->getConnection();

$film = new Film($db);
$genre = new Genre($db); // Untuk dropdown
$sutradara = new Sutradara($db); // Untuk dropdown

// Logika CRUD
$action = isset($_POST['action']) ? $_POST['action'] : '';
$edit_id = isset($_GET['edit_id']) ? $_GET['edit_id'] : '';
$data_edit = null;

if ($action == 'create') {
    $film->create($_POST['judul'], $_POST['tahun'], $_POST['durasi'], $_POST['rating'], $_POST['id_genre'], $_POST['id_sutradara']);
    header("Location: index.php?page=film");
}
if ($action == 'update') {
    $film->update($_POST['id_film'], $_POST['judul'], $_POST['tahun'], $_POST['durasi'], $_POST['rating'], $_POST['id_genre'], $_POST['id_sutradara']);
    header("Location: index.php?page=film");
}
if (isset($_GET['delete_id'])) {
    $film->delete($_GET['delete_id']);
    header("Location: index.php?page=film");
}
if ($edit_id) {
    $data_edit = $film->readOne($edit_id);
}

// Ambil data untuk tabel dan dropdown
$stmt_film = $film->read();
$stmt_genre = $genre->read(); 
$stmt_sutradara = $sutradara->read();
?>
<div class="content">
    <h2>Data Film</h2>
    <h3><?php echo $edit_id ? 'Edit' : 'Tambah'; ?> Film</h3>
    
    <form action="index.php?page=film" method="POST">
        <?php if ($edit_id): ?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id_film" value="<?php echo $data_edit['id_film']; ?>">
        <?php else: ?>
            <input type="hidden" name="action" value="create">
        <?php endif; ?>

        <label>Judul Film:</label>
        <input type="text" name="judul" value="<?php echo $edit_id ? $data_edit['judul_film'] : ''; ?>" required>
        
        <label>Tahun Rilis:</label>
        <input type="number" name="tahun" value="<?php echo $edit_id ? $data_edit['tahun_rilis'] : ''; ?>" required>
        
        <label>Durasi (dalam menit):</label>
        <input type="number" name="durasi" value="<?php echo $edit_id ? $data_edit['durasi_menit'] : ''; ?>">
        
        <label>Rating Usia:</label>
        <select name="rating" style="width: 96%; padding: 8px; margin-bottom: 10px;">
            <?php $ratings = ['G', 'PG', 'PG-13', 'R', 'SU']; ?>
            <?php foreach ($ratings as $r): ?>
                <option value="<?php echo $r; ?>" <?php echo ($edit_id && $data_edit['rating_usia'] == $r) ? 'selected' : ''; ?>>
                    <?php echo $r; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label>Genre:</label>
        <select name="id_genre" style="width: 96%; padding: 8px; margin-bottom: 10px;">
            <option value="0">-- Pilih Genre --</option>
            <?php while ($row_g = $stmt_genre->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row_g['id_genre']; ?>" <?php echo ($edit_id && $data_edit['id_genre'] == $row_g['id_genre']) ? 'selected' : ''; ?>>
                    <?php echo $row_g['nama_genre']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        
        <label>Sutradara:</label>
        <select name="id_sutradara" style="width: 96%; padding: 8px; margin-bottom: 10px;">
            <option value="0">-- Pilih Sutradara --</option>
            <?php while ($row_s = $stmt_sutradara->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row_s['id_sutradara']; ?>" <?php echo ($edit_id && $data_edit['id_sutradara'] == $row_s['id_sutradara']) ? 'selected' : ''; ?>>
                    <?php echo $row_s['nama_sutradara']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        
        <button type="submit"><?php echo $edit_id ? 'Update' : 'Simpan'; ?></button>
    </form>
    <hr>
    <h3>Daftar Film di Perpustakaan</h3>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun</th>
                <th>Durasi</th>
                <th>Rating</th>
                <th>Genre</th>
                <th>Sutradara</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt_film->fetch(PDO::FETCH_ASSOC)): extract($row); ?>
            <tr>
                <td><?php echo $judul_film; ?></td>
                <td><?php echo $tahun_rilis; ?></td>
                <td><?php echo konversiDurasi($durasi_menit); ?></td>
                <td><?php echo $rating_usia; ?></td>
                <td><?php echo $nama_genre; ?></td>
                <td><?php echo $nama_sutradara; ?></td>
                <td>
                    <a href='index.php?page=film&edit_id=<?php echo $id_film; ?>' class='btn-edit'>Edit</a>
                    <a href='index.php?page=film&delete_id=<?php echo $id_film; ?>' onclick='return confirm("Yakin?")' class='btn-delete'>Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>