<?php
// view/home.php

include_once 'config/Database.php';
include_once 'class/Film.php';
include_once 'class/Genre.php';
include_once 'class/Sutradara.php';


$database = new Database();
$db = $database->getConnection();

$film = new Film($db);
$genre = new Genre($db);
$sutradara = new Sutradara($db);


$stmt_film_all = $film->read();
$stmt_genre_all = $genre->read();
$stmt_sutradara_all = $sutradara->read();


$film_count = $stmt_film_all->rowCount();
$genre_count = $stmt_genre_all->rowCount();
$sutradara_count = $stmt_sutradara_all->rowCount();


function konversiDurasi($menit) {
    if ($menit < 1 || !is_numeric($menit)) return "-";
    $jam = floor($menit / 60);
    $sisaMenit = $menit % 60;
    $hasil = "";
    if ($jam > 0) $hasil .= $jam . " jam ";
    if ($sisaMenit > 0) $hasil .= $sisaMenit . " menit";
    return trim($hasil);
}
?>

<div class="content">
    <h2>Dashboard</h2>
    <p>Selamat datang di panel admin Movie Library Anda.</p>
    
    <div class="stat-cards-container">
        
        <div class="stat-card">
            <h4>Total Film</h4>
            <p><?php echo $film_count; ?></p>
        </div>
        
        <div class="stat-card">
            <h4>Total Genre</h4>
            <p><?php echo $genre_count; ?></p>
        </div>
        
        <div class="stat-card">
            <h4>Total Sutradara</h4>
            <p><?php echo $sutradara_count; ?></p>
        </div>
        
    </div>

    <hr>

    <h3>Koleksi Film Terbaru</h3>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tahun</th>
                <th>Durasi</th>
                <th>Genre</th>
                <th>Sutradara</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Tampilkan data film jika ada
            if ($film_count > 0):
                while ($row = $stmt_film_all->fetch(PDO::FETCH_ASSOC)):
                    extract($row);
            ?>
                <tr>
                    <td><?php echo $judul_film; ?></td>
                    <td><?php echo $tahun_rilis; ?></td>
                    <td><?php echo konversiDurasi($durasi_menit); ?></td>
                    <td><?php echo $nama_genre; ?></td>
                    <td><?php echo $nama_sutradara; ?></td>
                </tr>
            <?php
                endwhile;
            else:
                // Tampilkan pesan jika tidak ada film
                echo "<tr><td colspan='5' style='text-align: center;'>Belum ada film yang didaftarkan.</td></tr>";
            endif;
            ?>
        </tbody>
    </table>
</div>