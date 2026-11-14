<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';

// Admin giris yapmamissa giris sayfasina yonlendir
if (!Auth::check()) {
    header('Location: /admin/login.php');
    exit;
}

// Giris yapan adminin kullanici adi
$username = $_SESSION['admin_username'] ?? 'Yonetici';

// Cikis islemi icin CSRF token olustur
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['csrf_token'];

header('Cache-Control: no-store, private');

?>


<?php
// Sayfanin basligi
$pageTitle = 'Yönetim Paneli | Yapı ve Dekorasyon';

// Admin menusunu goster
$showAdminNavigation = true;

// Ortak Admin Header
require __DIR__ . '/../../app/Views/admin/partials/header.php';
?>


    
<main>
    <p>
        Hoş geldiniz,
        <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>!
    </p>






</main>
<?php
// Ortak Admin Footer
require __DIR__ . '/../../app/Views/admin/partials/footer.php';
?>
