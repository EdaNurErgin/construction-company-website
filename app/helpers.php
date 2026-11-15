<?php

// Guvenli ayarlarla PHP oturumunu baslat
function start_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start([
            'cookie_httponly' => true,
            'cookie_secure' => !empty($_SERVER['HTTPS'])
                && $_SERVER['HTTPS'] !== 'off',
            'cookie_samesite' => 'Lax',
            'use_strict_mode' => true
        ]);
    }
}

// HTML ciktisi icin degeri guvenli hale getir (XSS korumasi)
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// Oturumdaki CSRF token'i getir, yoksa olustur
function csrf_token(string $key = 'csrf_token'): string
{
    if (empty($_SESSION[$key])) {
        $_SESSION[$key] = bin2hex(random_bytes(32));
    }

    return $_SESSION[$key];
}

// Formdan gelen CSRF token'i oturumdaki token ile karsilastir
function verify_csrf(string $key = 'csrf_token'): bool
{
    $sessionToken = $_SESSION[$key] ?? '';
    $submittedToken = $_POST['csrf_token'] ?? '';

    return is_string($sessionToken)
        && $sessionToken !== ''
        && is_string($submittedToken)
        && hash_equals($sessionToken, $submittedToken);
}

// Giris yapmamis kullaniciyi admin giris sayfasina yonlendir
// (Auth sinifi app/Auth/Auth.php ile yuklenmis olmalidir)
function require_admin(): void
{
    if (!Auth::check()) {
        header('Location: /admin/login.php');
        exit;
    }
}
