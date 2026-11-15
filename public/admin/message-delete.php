
<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';
require_once __DIR__ . '/../../app/Repositories/MessageRepository.php';

// Sadece giris yapmis admin mesaj silebilir
require_admin();

// Silme islemi yalnizca POST ile yapilabilir
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('Bu islem yalnizca POST ile yapilabilir.');
}

// CSRF token dogrulamasi
if (!verify_csrf('message_delete_csrf_token')) {
    http_response_code(403);
    exit('Gecersiz guvenlik anahtari.');
}

// Silinecek mesajin ID degerini kontrol et
$id = filter_var(
    $_POST['id'] ?? null,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1]]
);

if (!is_int($id)) {
    http_response_code(400);
    exit('Gecersiz mesaj ID.');
}

// Kullanicinin bulundugu sayfayi koru
$page = filter_var(
    $_POST['page'] ?? 1,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1]]
);

if (!is_int($page)) {
    $page = 1;
}

// Mesaji veritabanindan sil
$messageRepository = new MessageRepository();
$messageRepository->delete($id);

// Mesaj listesine geri don
header(
    'Location: /admin/messages.php?page=' . $page,
    true,
    303
);
exit;
