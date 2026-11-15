
<?php
/** @var array $services */
/** @var string $csrfToken */
/** @var int $page */
/** @var int $totalPages */
/** @var int $totalServices */

$pageTitle = 'Hizmet Yönetimi | Yapı ve Dekorasyon';
$showAdminNavigation = true;

// Ortak admin Header
require __DIR__ . '/partials/header.php';
?>

<main id="main-content" class="admin-main">
    <div class="layout-container">

        <div class="page-heading">
            <div>
                <h1 class="page-heading__title">Hizmet Yönetimi</h1>

                <p class="page-heading__meta">
                    Toplam Hizmet Sayısı:
                    <strong><?= (int) $totalServices ?></strong>
                </p>
            </div>

            <!-- Yeni hizmet ekleme -->
            <a href="/admin/service-create.php" class="btn btn--primary">
                + Yeni Hizmet Ekle
            </a>
        </div>

        <!-- Hizmet listesi ve sayfalama -->
        <div id="admin-service-list" data-pagination-region>

            <?php if (empty($services)): ?>

                <p class="empty-state">Henüz eklenmiş bir hizmet bulunmuyor.</p>

            <?php else: ?>

                <div class="table-wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Hizmet Başlığı</th>
                                <th scope="col">Açıklama</th>
                                <th scope="col">Eklenme Tarihi</th>
                                <th scope="col"><span class="sr-only">İşlemler</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($services as $service): ?>
                                <tr>
                                    <td data-label="ID" class="data-table__id">
                                        <?= (int) $service['id'] ?>
                                    </td>

                                    <td data-label="Hizmet Başlığı" class="data-table__title">
                                        <?= e($service['title']) ?>
                                    </td>

                                    <td data-label="Açıklama">
                                        <div class="line-clamp-3">
                                            <?= nl2br(e($service['description'])) ?>
                                        </div>
                                    </td>

                                    <td data-label="Eklenme Tarihi" class="data-table__date">
                                        <?= e($service['created_at']) ?>
                                    </td>

                                    <td data-label="İşlemler">
                                        <div class="table-actions">
                                            <!-- Hizmet duzenleme -->
                                            <a
                                                href="/admin/service-edit.php?id=<?= (int) $service['id'] ?>"
                                                class="btn btn--outline btn--sm"
                                            >
                                                Düzenle
                                            </a>

                                            <!-- Hizmet silme -->
                                            <form
                                                action="/admin/service-delete.php"
                                                method="POST"
                                                class="inline-form"
                                                data-confirm="Bu hizmeti silmek istediğinize emin misiniz?"
                                            >

                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= (int) $service['id'] ?>"
                                                >

                                                <input
                                                    type="hidden"
                                                    name="csrf_token"
                                                    value="<?= e($csrfToken) ?>"
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

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>

                <nav class="pagination" aria-label="Hizmet sayfalama">

                    <!-- Onceki sayfa -->
                    <?php if ($page > 1): ?>

                        <a href="/admin/services.php?page=<?= $page - 1 ?>">
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

                            <a href="/admin/services.php?page=<?= $i ?>">
                                <?= $i ?>
                            </a>

                        <?php endif; ?>

                    <?php endfor; ?>

                    <!-- Sonraki sayfa -->
                    <?php if ($page < $totalPages): ?>

                        <a href="/admin/services.php?page=<?= $page + 1 ?>">
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
