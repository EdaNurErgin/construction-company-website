
<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';

// Sadece POST istegine izin ver
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('Bu isleme izin verilmiyor.');
}

// Admin giris yapmis mi?
require_admin();

// CSRF token kontrolu
if (!verify_csrf()) {
    http_response_code(403);
    exit('Gecersiz istek.');
}

// Admin oturumunu sonlandir
Auth::logout();

// Giris sayfasina yonlendir
header('Location: /admin/login.php', true, 303);
exit;
