<?php
/** @var string $csrfToken */
/** @var string|null $error */
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Girişi</title>
</head>
<body>

    <h1>Yönetici Girişi</h1>

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

</body>
</html>
