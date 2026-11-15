<?php

$pageTitle = $pageTitle ?? 'Yönetim Paneli | Yapı ve Dekorasyon';

$showAdminNavigation = $showAdminNavigation ?? false;

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= e($pageTitle) ?>
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="/assets/css/app.css">

    <script>document.documentElement.classList.add('js');</script>
    <script src="/assets/js/navigation.js" defer></script>
    <script src="/assets/js/pagination.js" defer></script>
    <script src="/assets/js/confirm-dialog.js" defer></script>
</head>

<body>

<a href="#main-content" class="skip-link">İçeriğe geç</a>

<header class="admin-header">
    <div class="layout-container admin-header__inner">

        <div class="brand">
            <span class="brand__mark" aria-hidden="true">YD</span>
            <span>
                Yapı ve Dekorasyon
                <span class="brand__note">Yönetim Paneli</span>
            </span>
        </div>

        <?php if ($showAdminNavigation): ?>

            <button
                type="button"
                class="nav-toggle"
                aria-controls="admin-nav"
                aria-expanded="false"
                data-nav-toggle
            >
                <span class="sr-only">Menüyü aç/kapat</span>
                <svg class="nav-toggle__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>

            <nav id="admin-nav" class="admin-nav" aria-label="Yönetim menüsü">

                <a href="/admin/index.php" class="admin-nav__link">Panel</a>

                <a href="/admin/services.php" class="admin-nav__link">Hizmetler</a>

                <a href="/admin/messages.php" class="admin-nav__link">Gelen Mesajlar</a>

                <a href="/admin/register.php" class="admin-nav__link">Yönetici Ekle</a>

                <a href="/" class="admin-nav__link">Siteye Dön</a>

                <!-- Guvenli cikis formu -->
                <form
                    action="/admin/logout.php"
                    method="POST"
                    class="admin-nav__form"
                >

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= e(csrf_token()) ?>"
                    >

                    <button type="submit" class="admin-nav__link">
                        Çıkış Yap
                    </button>

                </form>

            </nav>

        <?php else: ?>

            <nav aria-label="Geri dönüş">
                <a href="/" class="admin-nav__link">&larr; Siteye Dön</a>
            </nav>

        <?php endif; ?>

    </div>
</header>
