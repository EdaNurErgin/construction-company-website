
<?php

require_once __DIR__ . '/../Database/Database.php';

class MessageRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    // Yeni mesaj kaydetme
    public function create(
        string $firstName,
        string $lastName,
        string $message
    ): int {

        $sql = "INSERT INTO messages
                (first_name, last_name, message)
                VALUES
                (:first_name, :last_name, :message)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'message' => $message
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    // Tum mesajlari getir (mevcut metot)
    public function getAll(): array
    {
        $sql = "SELECT id, first_name, last_name,
                       message, created_at
                FROM messages
                ORDER BY created_at DESC, id DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    // Sayfalama ile mesajlari getir
    public function getPaginated(
        int $limit,
        int $offset
    ): array {

        if ($limit < 1 || $offset < 0) {
            throw new InvalidArgumentException(
                'Gecersiz sayfalama parametreleri.'
            );
        }

        $sql = "SELECT id, first_name, last_name,
                       message, created_at
                FROM messages
                ORDER BY created_at DESC, id DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(
            ':limit',
            $limit,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':offset',
            $offset,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Toplam mesaj sayisini getir
    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) FROM messages";

        $stmt = $this->pdo->query($sql);

        return (int) $stmt->fetchColumn();
    }


    // ID'ye gore mesaj silme
    public function delete(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        $sql = "DELETE FROM messages WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

}
