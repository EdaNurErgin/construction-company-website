
<?php
/** @var array $services */
/** @var int $page */
/** @var int $totalPages */

$pageTitle = 'Hizmetlerimiz | Yapı ve Dekorasyon';

// Ortak Header
require __DIR__ . '/../partials/header.php';
?>

<main>

    <section>
        <h2>Hizmetlerimiz</h2>

        <p>
            Yapı ve dekorasyon alanında sunduğumuz
            hizmetleri aşağıda inceleyebilirsiniz.
        </p>

        <?php if (empty($services)): ?>

            <p>Henüz eklenmiş bir hizmet bulunmuyor.</p>

        <?php else: ?>

            <?php foreach ($services as $service): ?>

                <article>
                    <h3>
                        <?= htmlspecialchars(
                            $service['title'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </h3>

                    <p>
                        <?= nl2br(htmlspecialchars(
                            $service['description'],
                            ENT_QUOTES,
                            'UTF-8'
                        )) ?>
                    </p>
                </article>

                <hr>

            <?php endforeach; ?>

        <?php endif; ?>

    </section>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>

        <nav aria-label="Hizmet sayfalama">

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

</main>

<?php
// Ortak Footer
require __DIR__ . '/../partials/footer.php';
?>
