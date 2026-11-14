
<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';
require_once __DIR__ . '/../../app/Repositories/ServiceRepository.php';

// Sadece giris yapan admin hizmet silebilir
if (!Auth::check()) {
    header('Location: /admin/login.php');
    exit;
}

header('Cache-Control: no-store, private');

// Silme islemi sadece POST ile yapilabilir
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit('Bu islem sadece POST istegiyle yapilabilir.');
}

// CSRF token kontrolu
$csrfToken = $_SESSION['csrf_token'] ?? '';
$submittedToken = $_POST['csrf_token'] ?? '';

if (
    !is_string($csrfToken) ||
    $csrfToken === '' ||
    !is_string($submittedToken) ||
    !hash_equals($csrfToken, $submittedToken)
) {
    http_response_code(403);
    exit('Gecersiz istek.');
}

// Silinecek hizmetin ID bilgisini al
$id = filter_var(
    $_POST['id'] ?? null,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1]]
);

if (!is_int($id)) {
    http_response_code(400);
    exit('Gecersiz hizmet ID.');
}

// Veritabanina baglan
$repository = new ServiceRepository();

// Hizmet mevcut mu kontrol et
$service = $repository->getById($id);

if ($service === null) {
    http_response_code(404);
    exit('Silinecek hizmet bulunamadi.');
}

// Hizmeti veritabanindan sil
$repository->delete($id);

// Silme isleminden sonra hizmet listesine don
header('Location: /admin/services.php', true, 303);
exit;
