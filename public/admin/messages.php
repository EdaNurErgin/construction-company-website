
<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';
require_once __DIR__ . '/../../app/Repositories/MessageRepository.php';

// Sadece giris yapan admin mesajlari gorebilir
require_admin();

// Mesaj silme islemi icin CSRF token olustur ve gorunume aktar
$deleteCsrfToken = csrf_token('message_delete_csrf_token');

// Mesajlarin tarayici onbelleginde tutulmasini engelle
header('Cache-Control: no-store, private');

// Repository nesnesini olustur
$messageRepository = new MessageRepository();

// Her sayfada gosterilecek mesaj sayisi
$perPage = 10;

// URL'den sayfa numarasini al
$page = filter_var(
    $_GET['page'] ?? 1,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1]]
);

// Gecersiz sayfa numarasi girilirse 1. sayfayi kullan
if (!is_int($page)) {
    $page = 1;
}

// Toplam mesaj sayisini getir
$totalMessages = $messageRepository->countAll();

// Toplam sayfa sayisini hesapla
$totalPages = max(
    1,
    (int) ceil($totalMessages / $perPage)
);

// Sayfa numarasi toplam sayfa sayisini gecmesin
$page = min($page, $totalPages);

// Kac kaydin atlanacagini hesapla
$offset = ($page - 1) * $perPage;

// Sadece ilgili sayfanin mesajlarini getir
$messages = $messageRepository->getPaginated(
    $perPage,
    $offset
);

// Gelen mesajlar arayuzunu goster
require __DIR__ . '/../../app/Views/admin/messages.php';
