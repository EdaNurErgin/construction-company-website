<?php

require_once __DIR__ . '/../Database/Database.php';

class AdminRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    // Kullanici adina gore admin getir
    public function getByUsername(string $username): ?array
    {
        $sql = "SELECT id, username, password_hash
                FROM admins
                WHERE username = :username";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'username' => $username
        ]);

        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    // Yeni admin ekle (sifre hashlenmis olarak gelmeli)
    public function create(string $username, string $passwordHash): int
    {
        $sql = "INSERT INTO admins (username, password_hash)
                VALUES (:username, :password_hash)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'username' => $username,
            'password_hash' => $passwordHash
        ]);

        return (int) $this->pdo->lastInsertId();
    }
}
