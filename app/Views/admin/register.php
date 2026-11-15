<?php
/** @var bool $isLoggedIn */
/** @var string $csrfToken */
/** @var string|null $error */
/** @var string|null $success */
/** @var string $username */
?>


<?php
// Sayfanin tarayici basligi
$pageTitle = 'Yönetici Kaydı | Yapı ve Dekorasyon';

// Admin menusunu sadece giris yapilmissa goster
$showAdminNavigation = $isLoggedIn;

// Ortak admin Header
require __DIR__ . '/partials/header.php';
?>

<main id="main-content" class="auth-page">

    <div class="panel auth-card">

        <h1 class="auth-card__title">Yönetici Kaydı</h1>

        <p class="auth-card__text">
            Yeni bir yönetici hesabı oluşturun.
        </p>

        <?php if (!empty($success)): ?>
            <p class="alert alert--success" role="status">
                <?= e($success) ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <p class="alert alert--error" role="alert">
                <?= e($error) ?>
            </p>
        <?php endif; ?>

        <form action="/admin/register.php" method="POST" class="form-stack">

            <!-- CSRF guvenlik kontrolu -->
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
                    minlength="3"
                    maxlength="50"
                    pattern="[A-Za-z0-9._\-]+"
                    autocomplete="username"
                    aria-describedby="username-hint"
                    value="<?= e($username) ?>"
                    required
                >

                <p id="username-hint" class="form-hint">
                    3-50 karakter; harf, rakam, nokta, tire ve alt çizgi.
                </p>
            </div>

            <div>
                <label for="password" class="form-label">Şifre</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    minlength="12"
                    maxlength="72"
                    autocomplete="new-password"
                    aria-describedby="password-hint"
                    required
                >

                <p id="password-hint" class="form-hint">En az 12 karakter.</p>
            </div>

            <div>
                <label for="password_confirm" class="form-label">Şifre (Tekrar)</label>

                <input
                    type="password"
                    id="password_confirm"
                    name="password_confirm"
                    class="form-control"
                    minlength="12"
                    maxlength="72"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="btn btn--primary btn--block">Yönetici Oluştur</button>

        </form>

        <?php if (!$isLoggedIn): ?>
            <p class="auth-card__footer">
                Zaten hesabınız var mı?
                <a href="/admin/login.php">Giriş yapın</a>
            </p>
        <?php endif; ?>

    </div>

</main>

<?php
// Ortak admin Footer
require __DIR__ . '/partials/footer.php';
?>
