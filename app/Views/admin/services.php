
<?php
/** @var array $services */
/** @var string $csrfToken */
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hizmet Yönetimi</title>
</head>
<body>

    <h1>Hizmet Yönetimi</h1>

    <p>
        <a href="/admin/index.php">
            Yönetim Paneline Dön
        </a>
    </p>

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

</body>
</html>
