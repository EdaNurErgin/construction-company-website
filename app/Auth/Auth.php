
<?php

require_once __DIR__ . '/../Repositories/AdminRepository.php';

class Auth
{
    // PHP oturumunu baslat
    private static function startSession(): void
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

    // Admin girisi
    public static function login(string $username, string $password): bool
    {
        self::startSession();

        $repository = new AdminRepository();

        $admin = $repository->getByUsername($username);

        // Kullanici yoksa veya sifre yanlissa
        if ($admin === null ||
            !password_verify($password, $admin['password_hash'])) {
            return false;
        }

        // Basarili giriste oturum kimligini yenile
        session_regenerate_id(true);

        $_SESSION['admin_id'] = (int) $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        return true;
    }

    // Admin giris yapmis mi?
    public static function check(): bool
    {
        self::startSession();

        return isset($_SESSION['admin_id']);
    }


    // Admin oturumunu sonlandir
    public static function logout(): void
    {
        self::startSession();

        // Oturum bilgilerini temizle
        $_SESSION = [];

        // Oturum cerezini sil
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(session_name(), '', [
                'expires' => time() - 3600,
                'path' => $params['path'],
                'domain' => $params['domain'],
                'secure' => $params['secure'],
                'httponly' => $params['httponly'],
                'samesite' => $params['samesite'] ?? 'Lax'
            ]);
        }

        // Oturumu sonlandir
        session_destroy();
    }

}
