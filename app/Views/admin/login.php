<?php
/** @var string $csrfToken */
/** @var string|null $error */
?>


<?php
// Tarayici sekmesindeki sayfa basligi
$pageTitle = 'Yönetici Girişi | Yapı ve Dekorasyon';

// Giris ekraninda admin menusunu gosterme
$showAdminNavigation = false;

// Ortak admin Header dosyasini ekle
require __DIR__ . '/partials/header.php';
?>


    <h2>Yönetici Girişi</h2>

    <?php if (!empty($error)): ?>
        <p role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <form action="/admin/login.php" method="POST">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>"
        >

        <div>
            <label for="username">Kullanıcı Adı</label>
            <input
                type="text"
                id="username"
                name="username"
                maxlength="50"
                autocomplete="username"
                required
            >
        </div>

        <div>
            <label for="password">Şifre</label>
            <input
                type="password"
                id="password"
                name="password"
                autocomplete="current-password"
                required
            >
        </div>

        <button type="submit">Giriş Yap</button>

    </form>


<?php
// Ortak admin Footer dosyasini ekle
require __DIR__ . '/partials/footer.php';
?>
