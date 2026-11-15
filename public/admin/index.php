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


<main id="main-content" class="admin-main">
    <div class="layout-container">

        <div class="page-heading">
            <div>
                <h1 class="page-heading__title">
                    Hoş geldiniz,
                    <?= e($username) ?>!
                </h1>
                <p class="page-heading__meta">
                    Hizmetleri ve gelen mesajları buradan yönetebilirsiniz.
                </p>
            </div>
        </div>

        <div class="dashboard-grid">
            <a href="/admin/services.php" class="panel link-card">
                <span class="link-card__title">Hizmetler</span>
                <span class="link-card__text">Hizmet ekleyin, düzenleyin veya silin.</span>
                <span class="link-card__cta">Hizmetlere git &rarr;</span>
            </a>

            <a href="/admin/messages.php" class="panel link-card">
                <span class="link-card__title">Gelen Mesajlar</span>
                <span class="link-card__text">İletişim formundan gelen mesajları görüntüleyin.</span>
                <span class="link-card__cta">Mesajlara git &rarr;</span>
            </a>

            <a href="/admin/register.php" class="panel link-card">
                <span class="link-card__title">Yönetici Ekle</span>
                <span class="link-card__text">Panele erişebilecek yeni bir yönetici hesabı oluşturun.</span>
                <span class="link-card__cta">Yönetici ekle &rarr;</span>
            </a>
        </div>

    </div>
</main>
<?php
// Ortak Admin Footer
require __DIR__ . '/../../app/Views/admin/partials/footer.php';
?>
