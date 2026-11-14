<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';

// Admin giris yapmamissa giris sayfasina yonlendir
if (!Auth::check()) {
    header('Location: /admin/login.php');
    exit;
}

// Giris yapan adminin kullanici adi
$username = $_SESSION['admin_username'] ?? 'Yonetici';

// Cikis islemi icin CSRF token olustur
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['csrf_token'];

header('Cache-Control: no-store, private');

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli</title>
</head>
<body>

    <h1>Yönetim Paneli</h1>

    <p>
        Hoş geldiniz,
        <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>!
    </p>

    <h2>Yönetim İşlemleri</h2>

    <p>
        <a href="/admin/services.php">Hizmetleri Yönet</a>
    </p>

    <!-- Admin cikis formu -->
    <form action="/admin/logout.php" method="POST">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>"
        >

        <button type="submit">Çıkış Yap</button>

    </form>

</body>
</html>
