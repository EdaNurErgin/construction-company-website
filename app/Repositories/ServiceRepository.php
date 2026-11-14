
<?php

require_once __DIR__ . '/../Database/Database.php';

class ServiceRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    // Tum hizmetleri listele
    public function getAll(): array
    {
        $sql = "SELECT * FROM services ORDER BY id DESC";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    // Anasayfada son 3 hizmeti listele
    public function getLatest(): array
    {
        $sql = "SELECT * FROM services ORDER BY id DESC LIMIT 3";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    // Hizmetleri sayfalayarak getir
    public function getPaginated(int $limit, int $offset): array
    {
        if ($limit < 1 || $offset < 0) {
            throw new InvalidArgumentException(
                'Gecersiz pagination parametreleri.'
            );
        }

        $sql = "SELECT * FROM services
                ORDER BY id DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Toplam hizmet sayisini getir
    public function countAll(): int
    {
        $sql = "SELECT COUNT(*) FROM services";

        $stmt = $this->pdo->query($sql);

        return (int) $stmt->fetchColumn();
    }

    // Yeni hizmet ekle
    public function create(string $title, string $description): int
    {
        $sql = "INSERT INTO services (title, description)
                VALUES (:title, :description)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'title' => $title,
            'description' => $description
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    // ID'ye gore hizmet getir
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM services WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        $service = $stmt->fetch();

        return $service ?: null;
    }

    // Hizmet bilgilerini guncelle
    public function update(
        int $id,
        string $title,
        string $description
    ): bool {
        $sql = "UPDATE services
                SET title = :title, description = :description
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description
        ]);
    }

    // ID'ye gore hizmet sil
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM services WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id
        ]);
    }
}
