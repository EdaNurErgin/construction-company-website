<?php

require_once __DIR__ . '/../app/Database/Database.php';

try {
    $pdo = Database::connect();

    // Veritabani baglantisini test et
    $pdo->query('SELECT 1');

    echo "MySQL baglantisi basarili!" . PHP_EOL;

} catch (PDOException $e) {
    echo "MySQL baglantisi basarisiz!" . PHP_EOL;
    exit(1);
}
