<?php
// Memanggil header
include_once 'view/header.php';
include_once 'view/menu.php';

// Router untuk memanggil halaman
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

echo '<div class="container">';
switch ($page) {
    case 'genre':
        include_once 'view/genre.php';
        break;
    case 'sutradara':
        include_once 'view/sutradara.php';
        break;
    case 'film':
        include_once 'view/film.php';
        break;
    case 'home':
    default:
        include_once 'view/home.php';
        break;
}
echo '</div>';

// Memanggil footer
include_once 'view/footer.php';
?>