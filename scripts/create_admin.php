<?php

// Bu dosya sadece terminalden calistirilabilir
if (PHP_SAPI !== 'cli') {
    exit('Bu script sadece terminalden calistirilabilir.');
}

require_once __DIR__ . '/../app/Database/Database.php';

// Admin bilgilerini al
echo "Admin kullanici adi: ";
$username = trim(fgets(STDIN));

echo "Admin sifresi: ";
$password = rtrim(fgets(STDIN), "\r\n");

// Bilgileri kontrol et
if ($username === '' || strlen($password) < 12) {
    exit("Kullanici adi bos olamaz. Sifre en az 12 karakter olmali." . PHP_EOL);
}

// Sifreyi hashle
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

try {
    $pdo = Database::connect();

    $sql = "INSERT INTO admins (username, password_hash)
            VALUES (:username, :password_hash)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'username' => $username,
        'password_hash' => $passwordHash
    ]);

    echo "Admin hesabi basariyla olusturuldu!" . PHP_EOL;

} catch (PDOException $e) {
    echo "Admin olusturulamadi. Kullanici adi zaten kullaniliyor olabilir veya veritabani hatasi olustu." . PHP_EOL;
    exit(1);
}
