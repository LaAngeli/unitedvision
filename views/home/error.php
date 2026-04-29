<?php




use app\helpers\TranslateHelper;

$translate = new TranslateHelper;


$this->title = $translate->t([
    [
        'lang' => 'en-US',
        'value' => 'Error 404 page not found'
    ],
    [
        'lang' => 'ro-RO',
        'value' => 'Eroare 404 pagina nu a fost găsită'
    ]
])
?>


.<div class="container">
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>404</h1>
            </div>
            <h2><?= $translate->t([
                    [
                        'lang' => 'en-US',
                        'value' => 'Oops! Nothing was found'
                    ],
                    [
                        'lang' => 'ro-RO',
                        'value' => ' Oops! Nu s-a găsit nimic'
                    ]
                ]) ?>
            </h2>
            <p>
                <?= $translate->t([
                    [
                        'lang' => 'en-US',
                        'value' => 'The page you are looking for might have been removed had its
                    name changed or is temporarily unavailable.'
                    ],
                    [
                        'lang' => 'ro-RO',
                        'value' => 'Pagina pe care o căutați ar fi putut fi eliminată, 
                    numele a fost schimbat sau este temporar indisponibil.'
                    ]
                ]) ?>

                <a href="/"><?= $translate->t([
                                [
                                    'lang' => 'en-US',
                                    'value' => 'Return to homepage'
                                ],
                                [
                                    'lang' => 'ro-RO',
                                    'value' => 'Reveniți la pagina principală'
                                ]
                            ]) ?></a>
            </p>
            <div class="notfound-social">
                <a href="https://www.instagram.com/unitedvision.md/"><i class="bi bi-instagram"></i></a>
                <a href="https://www.facebook.com/unitedvisionmoldova"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/unitedvisionmd"><i class="bi bi-twitter"></i></a>
                <a href="https://www.linkedin.com/company/united-vision-moldova/"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
</div>