<?php

/** @var string $csrfToken */
/** @var string|null $error */
/** @var int $id */

// Formun ekleme mi duzenleme mi oldugunu belirle
$isEdit = $isEdit ?? false;

// Duzenleme yapiliyorsa mevcut hizmet bilgileri gelir
$service = $service ?? [
    'title' => '',
    'description' => ''
];

// Formun gonderilecegi backend adresi
$formAction = $isEdit
    ? '/admin/service-edit.php?id=' . (int) $id
    : '/admin/service-create.php';

?>


<?php
// Sayfanin tarayici basligi
$pageTitle = 'Hizmet Formu | Yapı ve Dekorasyon';

// Yonetim menusunu goster
$showAdminNavigation = true;

// Ortak admin Header
require __DIR__ . '/partials/header.php';
?>


    <h3>
        <?= $isEdit ? 'Hizmet Düzenle' : 'Yeni Hizmet Ekle' ?>
    </h3>

    <p>
        <a href="/admin/services.php">Hizmetlere Dön</a>
    </p>

    <?php if (!empty($error)): ?>
        <p role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <form action="<?= htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8') ?>"
          method="POST">

        <!-- CSRF guvenlik kontrolu -->
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>"
        >

        <div>
            <label for="title">Hizmet Başlığı</label>

            <input
                type="text"
                id="title"
                name="title"
                maxlength="150"
                value="<?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?>"
                required
            >
        </div>

        <br>

        <div>
            <label for="description">Hizmet Açıklaması</label>

            <textarea
                id="description"
                name="description"
                rows="6"
                required
            ><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>

        <br>

        <button type="submit">
            <?= $isEdit ? 'Değişiklikleri Kaydet' : 'Hizmeti Kaydet' ?>
        </button>

    </form>


<?php
// Ortak admin Footer
require __DIR__ . '/partials/footer.php';
?>

