<?php

/** @var string $csrfToken */
/** @var string|null $error */
/** @var string|null $success */

$firstName = $firstName ?? '';
$lastName = $lastName ?? '';
$message = $message ?? '';

?>


<?php
// Sayfanin basligi
$pageTitle = 'İletişim | Yapı ve Dekorasyon';

// Ortak Header
require __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <header class="page-hero">
        <div class="layout-container">
            <a href="/" class="back-link">&larr; Ana Sayfaya Dön</a>

            <h1 class="page-hero__title">İletişim</h1>

            <p class="page-hero__text">
                Bizimle iletişime geçmek için aşağıdaki formu
                doldurabilirsiniz.
            </p>
        </div>
    </header>

    <section class="section">
        <div class="layout-container contact-layout">

            <aside aria-labelledby="contact-steps-title">
                <p class="eyebrow">Süreç</p>
                <h2 id="contact-steps-title" class="text-2xl">Mesajınızdan sonra</h2>

                <ol class="step-list">
                    <li class="feature">
                        <h3 class="feature__title">1. İnceleme</h3>
                        <p class="feature__text">Talebinizi ve ihtiyaçlarınızı değerlendiriyoruz.</p>
                    </li>
                    <li class="feature">
                        <h3 class="feature__title">2. Planlama</h3>
                        <p class="feature__text">Mekanınıza uygun çözüm önerilerini hazırlıyoruz.</p>
                    </li>
                    <li class="feature">
                        <h3 class="feature__title">3. Uygulama</h3>
                        <p class="feature__text">Projeyi özenle hayata geçiriyoruz.</p>
                    </li>
                </ol>
            </aside>

            <div class="panel">

                <!-- Hata mesaji -->
                <?php if (!empty($error)): ?>
                    <p class="alert alert--error" role="alert">
                        <?= e($error) ?>
                    </p>
                <?php endif; ?>

                <!-- Basari mesaji -->
                <?php if (!empty($success)): ?>
                    <p class="alert alert--success" role="status">
                        <?= e($success) ?>
                    </p>
                <?php endif; ?>

                <!-- Iletisim formu -->
                <form action="/contact.php" method="POST" class="form-stack">

                    <!-- CSRF token -->
                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= e($csrfToken) ?>"
                    >

                    <div class="form-row">
                        <div>
                            <label for="first_name" class="form-label">Ad</label>

                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                class="form-control"
                                maxlength="100"
                                autocomplete="given-name"
                                value="<?= e($firstName) ?>"
                                required
                            >
                        </div>

                        <div>
                            <label for="last_name" class="form-label">Soyad</label>

                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                class="form-control"
                                maxlength="100"
                                autocomplete="family-name"
                                value="<?= e($lastName) ?>"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label for="message" class="form-label">Mesajınız</label>

                        <textarea
                            id="message"
                            name="message"
                            class="form-control"
                            rows="6"
                            maxlength="5000"
                            aria-describedby="message-hint"
                            required
                        ><?= e($message) ?></textarea>

                        <p id="message-hint" class="form-hint">En fazla 5000 karakter.</p>
                    </div>

                    <button type="submit" class="btn btn--primary w-full sm:w-auto">
                        Mesaj Gönder
                    </button>

                </form>

            </div>

        </div>
    </section>

</main>
<?php
// Ortak Footer
require __DIR__ . '/../partials/footer.php';
?>
