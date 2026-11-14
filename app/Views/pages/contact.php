<?php

/** @var string $csrfToken */
/** @var string|null $error */
/** @var string|null $success */

$firstName = $firstName ?? '';
$lastName = $lastName ?? '';
$message = $message ?? '';

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim | Yapı ve Dekorasyon</title>
</head>
<body>

    <h1>İletişim</h1>

    <p>
        Bizimle iletişime geçmek için aşağıdaki formu
        doldurabilirsiniz.
    </p>

    <p>
        <a href="/">Ana Sayfaya Dön</a>
    </p>

    <!-- Hata mesaji -->
    <?php if (!empty($error)): ?>
        <p role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <!-- Basari mesaji -->
    <?php if (!empty($success)): ?>
        <p role="status">
            <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <!-- Iletisim formu -->
    <form action="/contact.php" method="POST">

        <!-- CSRF token -->
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>"
        >

        <div>
            <label for="first_name">Ad</label>

            <input
                type="text"
                id="first_name"
                name="first_name"
                maxlength="100"
                value="<?= htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <br>

        <div>
            <label for="last_name">Soyad</label>

            <input
                type="text"
                id="last_name"
                name="last_name"
                maxlength="100"
                value="<?= htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <br>

        <div>
            <label for="message">Mesajınız</label>

            <textarea
                id="message"
                name="message"
                rows="6"
                maxlength="5000"
                required
            ><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>

        <br>

        <button type="submit">
            Mesaj Gönder
        </button>

    </form>

</body>
</html>
