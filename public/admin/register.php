<?php

require_once __DIR__ . '/../../app/Auth/Auth.php';
require_once __DIR__ . '/../../app/Repositories/AdminRepository.php';

// Oturumu baslat ve giris durumunu ogren
$isLoggedIn = Auth::check();

header('Cache-Control: no-store, private');

// CSRF token olustur
$csrfToken = csrf_token();
$error = null;
$success = $_SESSION['register_success'] ?? null;
unset($_SESSION['register_success']);

$username = '';

// Form gonderildiyse
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF kontrolu
    if (!verify_csrf()) {
        http_response_code(403);
        $error = 'Gecersiz istek. Sayfayi yenileyin.';

    } else {

        $submittedUsername = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        // Form verilerini kontrol et
        if (
            !is_string($submittedUsername) ||
            !is_string($password) ||
            !is_string($passwordConfirm)
        ) {
            $error = 'Gecersiz form verisi.';

        } else {

            $username = trim($submittedUsername);

            if (!preg_match('/^[A-Za-z0-9._-]{3,50}$/', $username)) {
                $error = 'Kullanici adi 3-50 karakter olmali; sadece harf, rakam, nokta, tire ve alt cizgi icerebilir.';

            } elseif (strlen($password) < 12) {
                $error = 'Sifre en az 12 karakter olmali.';

            } elseif (strlen($password) > 72) {
                // password_hash (bcrypt) 72 byte sonrasini dikkate almaz
                $error = 'Sifre en fazla 72 karakter olabilir.';

            } elseif (!hash_equals($password, $passwordConfirm)) {
                $error = 'Sifreler eslesmiyor.';

            } else {

                $repository = new AdminRepository();

                try {
                    // Sifreyi hashleyerek admini kaydet
                    $repository->create(
                        $username,
                        password_hash($password, PASSWORD_DEFAULT)
                    );

                    $_SESSION['register_success'] =
                        'Yonetici hesabi basariyla olusturuldu.';

                    // Giris yapmamis kullanici giris sayfasina,
                    // giris yapmis admin tekrar forma doner
                    $redirectTo = $isLoggedIn
                        ? '/admin/register.php'
                        : '/admin/login.php';

                    header('Location: ' . $redirectTo, true, 303);
                    exit;

                } catch (PDOException $e) {

                    // 23000: UNIQUE kisitlamasi (kullanici adi zaten var)
                    if ($e->getCode() !== '23000') {
                        throw $e;
                    }

                    $error = 'Bu kullanici adi zaten kullaniliyor.';
                }
            }
        }
    }
}

// Kayit formunu goster
require __DIR__ . '/../../app/Views/admin/register.php';
