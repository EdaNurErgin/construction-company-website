
<?php

class Database
{
    public static function connect(): PDO
    {
        // Veritabani ayarlarini oku
        $config = require __DIR__ . '/../Config/config.php';

        // MySQL baglanti adresini olustur
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

        // PDO baglantisini olustur
        $pdo = new PDO(
            $dsn,
            $config['username'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );

        return $pdo;
    }
}
