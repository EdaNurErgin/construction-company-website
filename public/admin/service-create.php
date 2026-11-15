
<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';
require_once __DIR__ . '/../../app/Repositories/ServiceRepository.php';

// Sadece giris yapan admin hizmet ekleyebilir
require_admin();

header('Cache-Control: no-store, private');

// CSRF token olustur
$csrfToken = csrf_token();
$error = null;

// Form gonderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF kontrolu
    if (!verify_csrf()) {
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
