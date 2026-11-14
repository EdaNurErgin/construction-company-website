
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars(
            $pageTitle ?? 'Yapı ve Dekorasyon',
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </title>
</head>
<body>

    <header>
        <h1>Yapı ve Dekorasyon</h1>

        <nav aria-label="Ana menü">
            <a href="/">Anasayfa</a> |
            <a href="/services.php">Hizmetlerimiz</a> |
            <a href="/contact.php">İletişim</a>  |
            <a href="/admin/login.php">Yönetici Girişi</a>
        </nav>
    </header>

    <hr>
