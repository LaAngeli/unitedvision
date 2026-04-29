<?php

use app\modules\admin\components\BreadcrumbsWidget;
use yii\helpers\Html;

$this->title = 'Adaugă banner';
?>
<div class="grid-wrapper">
    <?= BreadcrumbsWidget::widget([
        'links' =>
        [
            [
                'label' => 'Acasă',
                'url' => '/admin',
            ],
            [
                'label' => 'Bannere',
                'url' => '/admin/main-banner'
            ],
            [
                'label' => $this->title,
            ],
        ]
    ])
    ?>
</div>

<div class="form-wrapper d-flex flex-column">
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'addForm' => $addForm,
    ]) ?>

</div>