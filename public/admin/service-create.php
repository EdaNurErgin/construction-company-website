
<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';
require_once __DIR__ . '/../../app/Repositories/ServiceRepository.php';

// Sadece giris yapan admin hizmet ekleyebilir
if (!Auth::check()) {
    header('Location: /admin/login.php');
    exit;
}

header('Cache-Control: no-store, private');

// CSRF token olustur
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$csrfToken = $_SESSION['csrf_token'];
$error = null;

// Form gonderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $submittedToken = $_POST['csrf_token'] ?? '';

    // CSRF kontrolu
    if (
        !is_string($submittedToken) ||
        !hash_equals($csrfToken, $submittedToken)
    ) {
        http_response_code(403);
        $error = 'Gecersiz istek. Sayfayi yenileyin.';

    } else {

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        // Form verilerini kontrol et
        if (!is_string($title) || !is_string($description)) {
            $error = 'Gecersiz form verisi.';

        } else {

            $title = trim($title);
            $description = trim($description);

            if ($title === '' || $description === '') {
                $error = 'Baslik ve aciklama bos birakilamaz.';

            } elseif (preg_match_all('/./us', $title) > 150) {
                $error = 'Baslik en fazla 150 karakter olabilir.';

            } else {

                // Hizmeti MySQL veritabanina kaydet
                $repository = new ServiceRepository();

                $repository->create($title, $description);

                // Basarili kayittan sonra listeye don
                header('Location: /admin/services.php', true, 303);
                exit;
            }
        }
    }
}

// Hizmet ekleme formunu goster
require __DIR__ . '/../../app/Views/admin/service-form.php';
