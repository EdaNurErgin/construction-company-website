
<?php
/** @var array $messages */
/** @var int $totalMessages */
/** @var int $totalPages */
/** @var int $page */
/** @var string $deleteCsrfToken */
?>


<?php
// Sayfanin tarayici basligi
$pageTitle = 'Gelen Mesajlar | Yapı ve Dekorasyon';

// Yonetim menusunu goster
$showAdminNavigation = true;

// Ortak admin Header
require __DIR__ . '/partials/header.php';
?>


    <h3>Gelen Mesajlar</h3>

    <!-- <p>
        <a href="/admin/index.php">
            Yönetim Paneline Dön
        </a>
    </p> -->

    <?php if (empty($messages)): ?>

        <p>Henüz bu sayfada gösterilecek mesaj bulunmuyor.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Mesaj</th>
                    <th>Gönderilme Tarihi</th>
                    <th>İşlem</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td>
                            <?= (int) $message['id'] ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $message['first_name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $message['last_name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= nl2br(htmlspecialchars(
                                $message['message'],
                                ENT_QUOTES,
                                'UTF-8'
                            )) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $message['created_at'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <!-- MESAJ SILME -->
                        <td>
                            <form
                                action="/admin/message-delete.php"
                                method="POST"
                                onsubmit="return confirm('Bu mesajı kalıcı olarak silmek istediğinize emin misiniz?');"
                            >
                                <input
                                    type="hidden"
                                    name="csrf_token"
                                    value="<?= htmlspecialchars(
                                        $deleteCsrfToken,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>"
                                >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $message['id'] ?>"
                                >

                                <input
                                    type="hidden"
                                    name="page"
                                    value="<?= (int) $page ?>"
                                >

                                <button type="submit">
                                    Sil
                                </button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <!-- PAGINATION -->


    <p></p>
    <?php if ($totalPages > 1): ?>

        <nav aria-label="Mesaj sayfalama">

            <!-- Onceki sayfa -->
            <?php if ($page > 1): ?>
                <a href="/admin/messages.php?page=<?= $page - 1 ?>">
                    &laquo; Önceki
                </a>
            <?php endif; ?>

            <!-- Sayfa numaralari -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                <?php if ($i === $page): ?>

                    <strong aria-current="page">
                        <?= $i ?>
                    </strong>

                <?php else: ?>

                    <a href="/admin/messages.php?page=<?= $i ?>">
                        <?= $i ?>
                    </a>

                <?php endif; ?>

            <?php endfor; ?>

            <!-- Sonraki sayfa -->
            <?php if ($page < $totalPages): ?>
                <a href="/admin/messages.php?page=<?= $page + 1 ?>">
                    Sonraki &raquo;
                </a>
            <?php endif; ?>

        </nav>

    <?php endif; ?>

    <p>
        Toplam <strong><?= (int) $totalMessages ?></strong> mesaj 
        
    </p>


<?php
// Ortak admin Footer
require __DIR__ . '/partials/footer.php';
?>
