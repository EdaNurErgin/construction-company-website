<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';
require_once __DIR__ . '/../../app/Repositories/ServiceRepository.php';

// Admin giris kontrolu
if (!Auth::check()) {
    header('Location: /admin/login.php');
    exit;
}

header('Cache-Control: no-store, private');

// Silme formu icin CSRF token olustur
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['csrf_token'];

// Repository nesnesini olustur
$serviceRepository = new ServiceRepository();

// Her sayfada gosterilecek hizmet sayisi
$perPage = 10;

// Toplam hizmet sayisini getir
$totalServices = $serviceRepository->countAll();

// Toplam sayfa sayisini hesapla
$totalPages = max(1, (int) ceil($totalServices / $perPage));

// URL'den sayfa numarasini al
$requestedPage = filter_input(
    INPUT_GET,
    'page',
    FILTER_VALIDATE_INT,
    [
        'options' => [
            'min_range' => 1
        ]
    ]
);

// Gecersiz sayfa numarasinda ilk sayfayi goster
$page = ($requestedPage === false || $requestedPage === null)
    ? 1
    : $requestedPage;

// Son sayfadan buyuk sayfa numarasini engelle
$page = min($page, $totalPages);

// Kac kayit atlanacagini hesapla
$offset = ($page - 1) * $perPage;

// Sadece ilgili sayfanin hizmetlerini getir
$services = $serviceRepository->getPaginated(
    $perPage,
    $offset
);

// Hizmet listesini goster
require __DIR__ . '/../../app/Views/admin/services.php';
