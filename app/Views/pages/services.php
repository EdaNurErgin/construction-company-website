<?php
/** @var array $services */
/** @var int $page */
/** @var int $totalPages */

$pageTitle = 'Hizmetlerimiz | Yapı ve Dekorasyon';

// Ortak Header
require __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <header class="page-hero">
        <div class="layout-container">
            <p class="eyebrow">Neler yapıyoruz</p>

            <h1 class="page-hero__title">Hizmetlerimiz</h1>

            <p class="page-hero__text">
                Yapı ve dekorasyon alanında sunduğumuz
                hizmetleri aşağıda inceleyebilirsiniz.
            </p>
        </div>
    </header>

    <section class="section" aria-label="Hizmet listesi">
        <div class="layout-container" id="service-list" data-pagination-region>

            <?php if (empty($services)): ?>

                <p class="empty-state">Henüz eklenmiş bir hizmet bulunmuyor.</p>

            <?php else: ?>

                <div class="card-grid">
                    <?php foreach ($services as $service): ?>

                        <article class="service-card">
                            <h2 class="service-card__title">
                                <?= e($service['title']) ?>
                            </h2>

                            <p class="service-card__text">
                                <?= nl2br(e($service['description'])) ?>
                            </p>
                        </article>

                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>

                <nav class="pagination" aria-label="Hizmet sayfalama">

                    <!-- Onceki sayfa -->
                    <?php if ($page > 1): ?>

                        <a href="/services.php?page=<?= $page - 1 ?>">
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

                            <a href="/services.php?page=<?= $i ?>">
                                <?= $i ?>
                            </a>

                        <?php endif; ?>

                    <?php endfor; ?>

                    <!-- Sonraki sayfa -->
                    <?php if ($page < $totalPages): ?>

                        <a href="/services.php?page=<?= $page + 1 ?>">
                            Sonraki &raquo;
                        </a>

                    <?php endif; ?>

                </nav>

            <?php endif; ?>

        </div>
    </section>

</main>

<?php
// Ortak Footer
require __DIR__ . '/../partials/footer.php';
?>
