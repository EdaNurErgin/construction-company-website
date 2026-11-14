<?php

require_once __DIR__ . '/../app/Repositories/MessageRepository.php';

$repository = new MessageRepository();

// 1. Yeni test mesaji olustur
echo "1. Mesaj kaydetme testi...\n";

$id = $repository->create(
    'Test',
    'Kullanici',
    'Bu bir test mesajidir.'
);

echo "Mesaj kaydedildi. ID: $id\n";

try {
    // 2. Tum mesajlari getir
    echo "\n2. Mesaj listeleme testi...\n";

    $messages = $repository->getAll();

    $found = false;

    foreach ($messages as $message) {
        if ((int) $message['id'] === $id) {
            $found = true;

            echo "Mesaj bulundu!\n";
            echo "Ad: " . $message['first_name'] . "\n";
            echo "Soyad: " . $message['last_name'] . "\n";
            echo "Mesaj: " . $message['message'] . "\n";

            break;
        }
    }

    if (!$found) {
        throw new RuntimeException(
            'Kaydedilen mesaj listede bulunamadi.'
        );
    }

    echo "\nTestler basarili!\n";

} finally {
    // 3. Test verisini temizle
    $pdo = Database::connect();

    $stmt = $pdo->prepare(
        "DELETE FROM messages WHERE id = :id"
    );

    $stmt->execute(['id' => $id]);

    echo "\nTest mesaji veritabanindan silindi.\n";
}
