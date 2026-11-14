
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

<main>

    <h3>Hizmet Yönetimi</h3>



    <!-- Yeni hizmet ekleme -->
    <p>
        <a href="/admin/service-create.php">
            + Yeni Hizmet Ekle
        </a>
    </p>

    <?php if (empty($services)): ?>

        <p>Henüz eklenmiş bir hizmet bulunmuyor.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hizmet Başlığı</th>
                    <th>Açıklama</th>
                    <th>Eklenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td>
                            <?= (int) $service['id'] ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $service['title'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= nl2br(htmlspecialchars(
                                $service['description'],
                                ENT_QUOTES,
                                'UTF-8'
                            )) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $service['created_at'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <!-- Hizmet duzenleme -->
                            <a href="/admin/service-edit.php?id=<?= (int) $service['id'] ?>">
                                Düzenle
                            </a>

                            <!-- Hizmet silme -->
                            <form
                                action="/admin/service-delete.php"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Bu hizmeti silmek istediğinize emin misiniz?');"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $service['id'] ?>"
                                >

                                <input
                                    type="hidden"
                                    name="csrf_token"
                                    value="<?= htmlspecialchars(
                                        $csrfToken,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>"
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
    <p></p>


    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>

        <nav aria-label="Hizmet sayfalama">

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

    <p>
        Toplam Hizmet Sayısı:
        <strong><?= (int) $totalServices ?></strong>
    </p>
    <!-- Sayfa bilgisi
    <p>
        Sayfa <?= (int) $page ?>
        / <?= (int) $totalPages ?>
    </p> -->

</main>

<?php
// Ortak admin Footer
require __DIR__ . '/partials/footer.php';
?>
