
<?php
/** @var array $latestServices */

// Sayfanin tarayici sekmesindeki basligi
$pageTitle = 'Anasayfa | Yapı ve Dekorasyon';

// Ortak Header
require __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- HERO -->
    <section class="hero">
        <div class="layout-container hero__inner">

            <div>
                <p class="eyebrow">Yapı · Tadilat · Dekorasyon</p>

                <h1 class="hero__title">
                    Yaşam alanlarınızı birlikte yeniden inşa edelim.
                </h1>

                <p class="hero__text">
                    Planlamadan son dokunuşa kadar her aşamada yanınızdayız.
                    Mekanlarınızı daha modern, estetik ve kullanışlı hale getiriyoruz.
                </p>

                <div class="hero__actions">
                    <a href="/services.php" class="btn btn--primary">Hizmetlerimizi İnceleyin</a>
                    <a href="/contact.php" class="btn btn--outline-light">Bize Ulaşın</a>
                </div>
            </div>

            <div class="blueprint" aria-hidden="true">
                <span class="blueprint__label">Uzmanlık alanları</span>

                <ul class="blueprint__list">
                    <li class="blueprint__item">
                        <span class="blueprint__number">01</span>
                        <span class="blueprint__title">İç Mekan Tasarımı</span>
                    </li>
                    <li class="blueprint__item">
                        <span class="blueprint__number">02</span>
                        <span class="blueprint__title">Tadilat</span>
                    </li>
                    <li class="blueprint__item">
                        <span class="blueprint__number">03</span>
                        <span class="blueprint__title">Dekorasyon</span>
                    </li>
                </ul>
            </div>

        </div>
    </section>

    <!-- HAKKIMIZDA -->
    <section class="section section--muted" aria-labelledby="about-title">
        <div class="layout-container about">

            <div>
                <p class="eyebrow">Biz kimiz</p>
                <h2 id="about-title" class="section-heading__title">Hakkımızda</h2>

                <div class="about__text mt-6">
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
                </div>
            </div>

            <ul class="feature-list">
                <li class="feature">
                    <h3 class="feature__title">Modern</h3>
                    <p class="feature__text">Güncel tasarım anlayışıyla planlanan yaşam alanları.</p>
                </li>
                <li class="feature">
                    <h3 class="feature__title">Estetik</h3>
                    <p class="feature__text">Malzeme, renk ve dokuda dengeli, özenli seçimler.</p>
                </li>
                <li class="feature">
                    <h3 class="feature__title">Kullanışlı</h3>
                    <p class="feature__text">İhtiyaçlarınıza göre şekillenen işlevsel çözümler.</p>
                </li>
            </ul>

        </div>
    </section>

    <!-- SON HIZMETLER -->
    <section class="section" aria-labelledby="latest-services-title">
        <div class="layout-container">

            <div class="section-heading">
                <p class="eyebrow">Hizmetler</p>
                <h2 id="latest-services-title" class="section-heading__title">Son Hizmetlerimiz</h2>
            </div>

            <?php if (empty($latestServices)): ?>

                <p class="empty-state">Henüz eklenmiş bir hizmet bulunmuyor.</p>

            <?php else: ?>

                <div class="card-grid card-grid--numbered">
                    <?php foreach ($latestServices as $service): ?>

                        <article class="service-card">
                            <h3 class="service-card__title">
                                <?= e($service['title']) ?>
                            </h3>

                            <p class="service-card__text line-clamp-5">
                                <?= nl2br(e($service['description'])) ?>
                            </p>
                        </article>

                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

            <p class="section-footer">
                <a href="/services.php" class="btn btn--dark">
                    Tüm Hizmetlerimizi Görüntüle
                </a>
            </p>

        </div>
    </section>

</main>

<?php
// Ortak Footer
require __DIR__ . '/../partials/footer.php';
?>
