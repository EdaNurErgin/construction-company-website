<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';

// Admin giris yapmamissa giris sayfasina yonlendir
require_admin();

// Giris yapan adminin kullanici adi
$username = $_SESSION['admin_username'] ?? 'Yonetici';

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
