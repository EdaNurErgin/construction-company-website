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

<main id="main-content" class="admin-main">
    <div class="layout-container form-page">

        <a href="/admin/services.php" class="back-link">&larr; Hizmetlere Dön</a>

        <h1 class="page-heading__title">
            <?= $isEdit ? 'Hizmet Düzenle' : 'Yeni Hizmet Ekle' ?>
        </h1>

        <div class="panel form-page__panel">

            <?php if (!empty($error)): ?>
                <p class="alert alert--error" role="alert">
                    <?= e($error) ?>
                </p>
            <?php endif; ?>

            <form action="<?= e($formAction) ?>"
                  method="POST"
                  class="form-stack">

                <!-- CSRF guvenlik kontrolu -->
                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= e($csrfToken) ?>"
                >

                <div>
                    <label for="title" class="form-label">Hizmet Başlığı</label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        maxlength="150"
                        aria-describedby="title-hint"
                        value="<?= e($service['title']) ?>"
                        required
                    >

                    <p id="title-hint" class="form-hint">En fazla 150 karakter.</p>
                </div>

                <div>
                    <label for="description" class="form-label">Hizmet Açıklaması</label>

                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="6"
                        required
                    ><?= e($service['description']) ?></textarea>
                </div>

                <div class="form-actions">
                    <a href="/admin/services.php" class="btn btn--outline">Vazgeç</a>

                    <button type="submit" class="btn btn--primary">
                        <?= $isEdit ? 'Değişiklikleri Kaydet' : 'Hizmeti Kaydet' ?>
                    </button>
                </div>

            </form>

        </div>

    </div>
</main>

<?php
// Ortak admin Footer
require __DIR__ . '/partials/footer.php';
?>
