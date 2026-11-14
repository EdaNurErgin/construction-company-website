
<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';

// Sadece POST istegine izin ver
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('Bu isleme izin verilmiyor.');
}

// Admin giris yapmis mi?
if (!Auth::check()) {
    header('Location: /admin/login.php', true, 303);
    exit;
}

// CSRF token kontrolu
$submittedToken = $_POST['csrf_token'] ?? '';
$sessionToken = $_SESSION['csrf_token'] ?? '';

if (
    !is_string($submittedToken) ||
    !is_string($sessionToken) ||
    $sessionToken === '' ||
    !hash_equals($sessionToken, $submittedToken)
) {
    http_response_code(403);
    exit('Gecersiz istek.');
}

// Admin oturumunu sonlandir
Auth::logout();

// Giris sayfasina yonlendir
header('Location: /admin/login.php', true, 303);
exit;
