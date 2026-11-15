<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';

// Oturumu baslat
if (Auth::check()) {
    header('Location: /admin/index.php');
    exit;
}
// CSRF token olustur
$csrfToken = csrf_token();
$error = null;

// Form gonderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF kontrolu
    if (!verify_csrf()) {
        http_response_code(403);
        $error = 'Gecersiz istek. Sayfayi yenileyip tekrar deneyin.';
    } else {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Form verilerini kontrol et
        if (
            !is_string($username) ||
            !is_string($password) ||
            trim($username) === '' ||
            $password === '' ||
            strlen(trim($username)) > 50
        ) {
            $error = 'Lutfen gecerli kullanici adi ve sifre girin.';
        } elseif (Auth::login(trim($username), $password)) {

            // Basarili giris
            unset($_SESSION['csrf_token']);

            header('Location: /admin/index.php', true, 303);
            exit;

        } else {
            $error = 'Kullanici adi veya sifre hatali.';
        }
    }
}

// Giris formunu goster
require __DIR__ . '/../../app/Views/admin/login.php';
