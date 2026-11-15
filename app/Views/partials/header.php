
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= e($pageTitle ?? 'Yapı ve Dekorasyon') ?>
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="/assets/css/app.css">

    <script>document.documentElement.classList.add('js');</script>
    <script src="/assets/js/navigation.js" defer></script>
    <script src="/assets/js/pagination.js" defer></script>
</head>
<body>

    <a href="#main-content" class="skip-link">İçeriğe geç</a>

    <header class="site-header">
        <div class="layout-container site-header__inner">

            <a href="/" class="brand">
                <span class="brand__mark" aria-hidden="true">YD</span>
                <span>Yapı ve Dekorasyon</span>
            </a>

            <button
                type="button"
                class="nav-toggle"
                aria-controls="site-nav"
                aria-expanded="false"
                data-nav-toggle
            >
                <span class="sr-only">Menüyü aç/kapat</span>
                <svg class="nav-toggle__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>

            <nav id="site-nav" class="site-nav" aria-label="Ana menü">
                <a href="/" class="site-nav__link">Anasayfa</a>
                <a href="/services.php" class="site-nav__link">Hizmetlerimiz</a>
                <a href="/contact.php" class="site-nav__link">İletişim</a>
                <a href="/admin/login.php" class="site-nav__link site-nav__link--cta">Yönetici Girişi</a>
            </nav>

        </div>
    </header>
