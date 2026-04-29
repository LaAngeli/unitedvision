<?php

use yii\helpers\Url;

?>

<!-- SERVICES START -->
<section data-aos="fade-down" data-aos-once="true" data-aos-duration="1000" class="services">
    <div class="container">
        <div class="services-wrapper d-flex flex-row align-items-center justify-content-center">
            <div class="images-wrapper d-flex flex-row">
                <div class="img-block">
                    <img src="uploads\img\gl1.webp" alt="" />
                </div>
                <div class="img-block d-flex flex-column justify-content-between">
                    <img src="uploads\img\gl2.jpeg" alt="" />
                    <img src="uploads\img\gl3.jpeg" alt="" />
                </div>
            </div>
            <div class="text-wrapper d-flex flex-column">
                <h3>Servicii</h3>
                <h2>
                    Gamă complexă de servicii
                </h2>
                <p>
                    Bun venit pe pagina noastră,
                    ne dedicăm să vă oferim o gamă completă
                    de servicii profesionale. De la deservirea
                    echipamentului optic și montarea lentilelor
                    de corectie, până la repararea ochelarilor,
                    suntem disponibili de a vă ajuta să mențineți confortul vederii dvs.
                </p>
                <a href="<?= Url::toRoute('/services') ?>"><span>Mai Mult</span></a>
            </div>
        </div>
    </div>
</section>
<!-- SERVICES END -->