<?php

require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/Repositories/ServiceRepository.php';

// Repository nesnesini olustur
$serviceRepository = new ServiceRepository();

// Her sayfada 6 hizmet goster
$perPage = 6;

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

// Gecersiz sayfa numarasinda 1. sayfayi kullan
$page = ($requestedPage === false || $requestedPage === null)
    ? 1
    : $requestedPage;

// Sayfa numarasini sinirla
$page = min($page, $totalPages);

// Atlanacak hizmet sayisini hesapla
$offset = ($page - 1) * $perPage;

// Yalnizca ilgili sayfanin hizmetlerini getir
$services = $serviceRepository->getPaginated(
    $perPage,
    $offset
);

// Hizmetlerimiz gorunumunu yukle
require __DIR__ . '/../app/Views/pages/services.php';
