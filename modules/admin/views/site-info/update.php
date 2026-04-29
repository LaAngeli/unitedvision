<?php

use app\modules\admin\components\ActionsButtonsWidget;
use app\modules\admin\components\BreadcrumbsWidget;
use yii\helpers\Html;
use app\helpers\UrlHelper as UrlCreator;

$urlCreator = new UrlCreator;

$this->title = 'Actualizare informații generale';

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
                'label' => "Informații generale",
                'url' => ['/admin/site-info']
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

    <?= ActionsButtonsWidget::widget([
        'buttons' =>
        [
            'view' =>
            [
                'label' => 'Detalii',
                'action' => ['index'],
                'icon' => '<span class="material-symbols-outlined">visibility</span>',
                'options' => ['class' => 'btn-action btn-primary']
            ],
        ]
    ])
    ?>

    <?= $this->render('_form', [
        'addForm' => $addForm,
    ]) ?>

</div>