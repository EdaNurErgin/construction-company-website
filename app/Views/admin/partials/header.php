
<?php

$pageTitle = $pageTitle ?? 'Yönetim Paneli | Yapı ve Dekorasyon';

$showAdminNavigation = $showAdminNavigation ?? false;

// Admin cikis islemi icin CSRF token olustur
// Mevcut token varsa degistirme
if ($showAdminNavigation && empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>
    </title>
</head>

<body>

<header>
    <h1>Yapı ve Dekorasyon | Yönetim Paneli</h1>
    
    

    <?php if ($showAdminNavigation): ?>

        <nav aria-label="Yönetim menüsü">

            <a href="/admin/index.php">Panel</a> |

            <a href="/admin/services.php">Hizmetler</a> |

            <a href="/admin/messages.php">Gelen Mesajlar</a> |

            <a href="/">Siteye Dön</a> |

            <!-- Guvenli cikis formu -->
            <form
                action="/admin/logout.php"
                method="POST"
                style="display: inline;"
            >

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= htmlspecialchars(
                        $_SESSION['csrf_token'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                >

                <button type="submit">
                    Çıkış Yap
                </button>

            </form>

        </nav>

    <?php else: ?>

        <nav aria-label="Geri dönüş">
            <a href="/">Siteye Dön</a>
        </nav>

    <?php endif; ?>

</header>

<hr>
