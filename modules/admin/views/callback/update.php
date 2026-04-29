<?php

use app\modules\admin\components\ActionsButtonsWidget;
use app\modules\admin\components\BreadcrumbsWidget;
use yii\helpers\Html;
use app\helpers\UrlHelper as UrlCreator;

$urlCreator = new UrlCreator;


$this->title = 'Actualizare serviciu: ' . Html::encode($model->name);

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
                'label' => 'Servicii',
                'url' => '/admin/services'
            ],
            [
                'label' => "Informații:  " . Html::encode($model->name),
                'url' => ['/admin/services/view', 'id' => $model->id, 'name' => $urlCreator->createUrl($model->name)]
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
            'create' =>
            [
                'label' => 'Adaugă',
                'action' => ['create'],
                'icon' => '<span class="material-symbols-outlined">add</span>',
                'cssTags' => ['class' => 'btn-action btn-success']
            ],

            'view' =>
            [
                'label' => 'Detalii',
                'action' => ['view', 'id' => $model->id, 'name' => $urlCreator->createUrl($model->name)],
                'icon' => '<span class="material-symbols-outlined">visibility</span>',
                'cssTags' => ['class' => 'btn-action btn-primary']
            ],

            'delete' =>
            [
                'label' => 'Șterge',
                'action' => ['delete', 'id' => $model->id, 'name' => $urlCreator->createUrl($model->name)],
                'icon' => '<span class="material-symbols-outlined">delete</span>',
                'cssTags' => ['class' => 'btn-action btn-danger']
            ],
        ]
    ])
    ?>

    <?= $this->render('_form', [
        'addForm' => $addForm,
    ]) ?>

</div>