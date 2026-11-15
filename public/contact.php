
<?php

require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/Repositories/MessageRepository.php';

// Ziyaretci icin oturum baslat
start_session();

header('Cache-Control: no-store, private');

// CSRF token olustur
$csrfToken = csrf_token('contact_csrf_token');

$error = null;
$success = $_SESSION['contact_success'] ?? null;
unset($_SESSION['contact_success']);

$firstName = '';
$lastName = '';
$message = '';

// Form gonderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF guvenlik kontrolu
    if (!verify_csrf('contact_csrf_token')) {
        http_response_code(403);
        $error = 'Gecersiz istek. Sayfayi yenileyin.';

    } else {

        $firstName = $_POST['first_name'] ?? '';
        $lastName = $_POST['last_name'] ?? '';
        $message = $_POST['message'] ?? '';

        // Gelen verilerin turunu kontrol et
        if (
            !is_string($firstName) ||
            !is_string($lastName) ||
            !is_string($message)
        ) {
            $error = 'Gecersiz form verisi.';

            $firstName = '';
            $lastName = '';
            $message = '';

        } else {

            $firstName = trim($firstName);
            $lastName = trim($lastName);
            $message = trim($message);

            // Karakter sayilarini kontrol et
            $firstNameLength = preg_match_all('/./us', $firstName);
            $lastNameLength = preg_match_all('/./us', $lastName);
            $messageLength = preg_match_all('/./us', $message);

            if (
                $firstName === '' ||
                $lastName === '' ||
                $message === ''
            ) {
                $error = 'Tum alanlari doldurmalisiniz.';

            } elseif (
                $firstNameLength === false ||
                $lastNameLength === false ||
                $messageLength === false
            ) {
                $error = 'Gecersiz karakterler girildi.';

            } elseif (
                $firstNameLength > 100 ||
                $lastNameLength > 100 ||
                $messageLength > 5000
            ) {
                $error = 'Alanlarin karakter sinirini astiniz.';

            } else {

                // Mesaji MySQL veritabanina kaydet
                $repository = new MessageRepository();

                $repository->create(
                    $firstName,
                    $lastName,
                    $message
                );

                // Basarili kayittan sonra CSRF token yenile
                $_SESSION['contact_csrf_token'] =
                    bin2hex(random_bytes(32));

                $_SESSION['contact_success'] =
                    'Mesajiniz basariyla gonderildi.';

                // Sayfaya yeniden yonlendir
                header('Location: /contact.php', true, 303);
                exit;
            }
        }
    }
}

// Iletisim formunu goster
require __DIR__ . '/../app/Views/pages/contact.php';
