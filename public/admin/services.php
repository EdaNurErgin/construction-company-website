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

// Hizmetleri veritabanindan getir
$serviceRepository = new ServiceRepository();
$services = $serviceRepository->getAll();

// Hizmet listesini goster
require __DIR__ . '/../../app/Views/admin/services.php';
