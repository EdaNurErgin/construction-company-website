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

<main id="main-content" class="auth-page">

    <div class="panel auth-card">

        <h1 class="auth-card__title">Yönetici Girişi</h1>

        <p class="auth-card__text">
            Devam etmek için yönetici bilgilerinizle giriş yapın.
        </p>

        <?php if (!empty($error)): ?>
            <p class="alert alert--error" role="alert">
                <?= e($error) ?>
            </p>
        <?php endif; ?>

        <form action="/admin/login.php" method="POST" class="form-stack">

            <input
                type="hidden"
                name="csrf_token"
                value="<?= e($csrfToken) ?>"
            >

            <div>
                <label for="username" class="form-label">Kullanıcı Adı</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    maxlength="50"
                    autocomplete="username"
                    required
                >
            </div>

            <div>
                <label for="password" class="form-label">Şifre</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="btn btn--primary btn--block">Giriş Yap</button>

        </form>

    </div>

</main>

<?php
// Ortak admin Footer dosyasini ekle
require __DIR__ . '/partials/footer.php';
?>
