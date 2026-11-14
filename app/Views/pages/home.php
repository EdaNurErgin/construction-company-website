
<?php
/** @var array $latestServices */

// Sayfanin tarayici sekmesindeki basligi
$pageTitle = 'Anasayfa | Yapı ve Dekorasyon';

// Ortak Header
require __DIR__ . '/../partials/header.php';
?>

<main>

    <!-- HAKKIMIZDA -->
    <section>
        <h2>Hakkımızda</h2>

        <p>
            Yapı ve Dekorasyon olarak yaşam alanlarını
            daha modern, estetik ve kullanışlı hale
            getirmek için hizmet veriyoruz.
        </p>

        <p>
            İç mekan tasarımı, tadilat ve dekorasyon
            alanlarında müşterilerimizin ihtiyaçlarına
            uygun çözümler sunmayı hedefliyoruz.
        </p>
    </section>

    <hr>

    <!-- SON HIZMETLER -->
    <section>
        <h2>Son Hizmetlerimiz</h2>

        <?php if (empty($latestServices)): ?>

            <p>Henüz eklenmiş bir hizmet bulunmuyor.</p>

        <?php else: ?>

            <?php foreach ($latestServices as $service): ?>

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

        <p>
            <a href="/services.php">
                Tüm Hizmetlerimizi Görüntüle
            </a>
        </p>
    </section>

</main>

<?php
// Ortak Footer
require __DIR__ . '/../partials/footer.php';
?>
