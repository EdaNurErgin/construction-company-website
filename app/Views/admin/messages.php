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

<main id="main-content" class="admin-main">
    <div class="layout-container">

        <div class="page-heading">
            <div>
                <h1 class="page-heading__title">Gelen Mesajlar</h1>

                <p class="page-heading__meta">
                    Toplam <strong><?= (int) $totalMessages ?></strong> mesaj
                </p>
            </div>
        </div>

        <!-- Mesaj listesi ve sayfalama -->
        <div id="admin-message-list" data-pagination-region>

            <?php if (empty($messages)): ?>

                <p class="empty-state">Henüz bu sayfada gösterilecek mesaj bulunmuyor.</p>

            <?php else: ?>

                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Ad</th>
                                <th scope="col">Soyad</th>
                                <th scope="col">Mesaj</th>
                                <th scope="col">Gönderilme Tarihi</th>
                                <th scope="col"><span class="sr-only">İşlem</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($messages as $message): ?>
                                <tr>
                                    <td data-label="ID" class="data-table__id">
                                        <?= (int) $message['id'] ?>
                                    </td>

                                    <td data-label="Ad" class="data-table__title">
                                        <?= e($message['first_name']) ?>
                                    </td>

                                    <td data-label="Soyad" class="data-table__title">
                                        <?= e($message['last_name']) ?>
                                    </td>

                                    <td data-label="Mesaj" class="data-table__message">
                                        <?= nl2br(e($message['message'])) ?>
                                    </td>

                                    <td data-label="Gönderilme Tarihi" class="data-table__date">
                                        <?= e($message['created_at']) ?>
                                    </td>

                                    <!-- MESAJ SILME -->
                                    <td data-label="İşlem">
                                        <div class="table-actions">
                                            <form
                                                action="/admin/message-delete.php"
                                                method="POST"
                                                class="inline-form"
                                                data-confirm="Bu mesajı kalıcı olarak silmek istediğinize emin misiniz?"
                                            >
                                                <input
                                                    type="hidden"
                                                    name="csrf_token"
                                                    value="<?= e($deleteCsrfToken) ?>"
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

                                                <button type="submit" class="btn btn--danger btn--sm">
                                                    Sil
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php endif; ?>

            <!-- PAGINATION -->
            <?php if ($totalPages > 1): ?>

                <nav class="pagination" aria-label="Mesaj sayfalama">

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

        </div>

    </div>
</main>

<?php
// Ortak admin Footer
require __DIR__ . '/partials/footer.php';
?>
