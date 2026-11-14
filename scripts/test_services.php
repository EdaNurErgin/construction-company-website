
<?php

require_once __DIR__ . '/../app/Repositories/ServiceRepository.php';

$repository = new ServiceRepository();
$id = null;

try {
    // 1. CREATE - Hizmet ekle
    $id = $repository->create(
        'TEST - Mutfak Tadilatı',
        'Test amacıyla eklenen hizmet.'
    );

    echo "1. Hizmet eklendi. ID: $id" . PHP_EOL;

    // 2. READ - ID ile hizmet getir
    $service = $repository->getById($id);

    if ($service === null) {
        throw new RuntimeException("Hizmet bulunamadi.");
    }

    echo "2. Hizmet bulundu: " . $service['title'] . PHP_EOL;

    // 3. READ - Hizmetleri listele
    $all = $repository->getAll();
    $latest = $repository->getLatest();

    echo "3. Toplam hizmet: " . count($all) . PHP_EOL;
    echo "   Son hizmetler: " . count($latest) . PHP_EOL;

    // 4. UPDATE - Hizmeti güncelle
    $repository->update(
        $id,
        'TEST - Banyo Tadilatı',
        'Guncellenmis test aciklamasi.'
    );

    $updated = $repository->getById($id);

    if ($updated === null ||
        $updated['title'] !== 'TEST - Banyo Tadilatı') {
        throw new RuntimeException("Guncelleme basarisiz.");
    }

    echo "4. Hizmet guncellendi: " . $updated['title'] . PHP_EOL;

    // 5. DELETE - Hizmeti sil
    $repository->delete($id);

    if ($repository->getById($id) !== null) {
        throw new RuntimeException("Silme basarisiz.");
    }

    $id = null;

    echo "5. Hizmet silindi." . PHP_EOL;
    echo "Tum CRUD testleri basarili!" . PHP_EOL;

} finally {
    // Test hata verirse eklenen test kaydini temizle
    if ($id !== null) {
        $repository->delete($id);
    }
}
