
<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';
require_once __DIR__ . '/../../app/Repositories/ServiceRepository.php';

// Sadece giris yapan admin duzenleme yapabilir
if (!Auth::check()) {
    header('Location: /admin/login.php');
    exit;
}

header('Cache-Control: no-store, private');

// URL'den hizmet ID'sini al
$id = filter_var(
    $_GET['id'] ?? null,
    FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1]]
);

// ID gecerli bir pozitif tam sayi olmali
if (!is_int($id)) {
    http_response_code(400);
    exit('Gecersiz hizmet ID.');
}

// Veritabanindan hizmeti getir
$repository = new ServiceRepository();
$service = $repository->getById($id);

if ($service === null || $service === false) {
    http_response_code(404);
    exit('Hizmet bulunamadi.');
}

// CSRF token olustur
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['csrf_token'];
$error = null;
$isEdit = true;

// Form gonderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $submittedToken = $_POST['csrf_token'] ?? '';

    // CSRF kontrolu
    if (
        !is_string($submittedToken) ||
        !hash_equals($csrfToken, $submittedToken)
    ) {
        http_response_code(403);
        $error = 'Gecersiz istek.';

    } else {

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        // Form verilerini kontrol et
        if (!is_string($title) || !is_string($description)) {
            $error = 'Gecersiz form verisi.';

        } else {

            $title = trim($title);
            $description = trim($description);

            // Hata durumunda girilen bilgileri koru
            $service['title'] = $title;
            $service['description'] = $description;

            if ($title === '' || $description === '') {
                $error = 'Baslik ve aciklama bos olamaz.';

            } else {

                // Baslik uzunlugunu kontrol et
                $titleLength = preg_match_all('/./us', $title);

                if ($titleLength === false) {
                    $error = 'Baslik gecersiz karakterler iceriyor.';

                } elseif ($titleLength > 150) {
                    $error = 'Baslik en fazla 150 karakter olabilir.';

                } else {

                    // Mevcut hizmeti guncelle
                    $repository->update($id, $title, $description);

                    // Hizmet listesine yonlendir
                    header('Location: /admin/services.php', true, 303);
                    exit;
                }
            }
        }
    }
}

// Duzenleme formunu goster
require __DIR__ . '/../../app/Views/admin/service-form.php';
