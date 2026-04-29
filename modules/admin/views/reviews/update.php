<?php

use app\modules\admin\components\ActionsButtonsWidget;
use app\modules\admin\components\BreadcrumbsWidget;
use yii\helpers\Html;
use app\helpers\UrlHelper as UrlCreator;
use app\modules\admin\components\ConfirmModalWidget as ConfirmModal;

$urlCreator = new UrlCreator;


$this->title = 'Actualizare recenzie: ' . Html::encode($model->initials);

?>
<div class="it-wrp">
    <div class="loader-ajax"></div>
    <div class="grid-wrapper">
        <?= BreadcrumbsWidget::widget([
            'links' =>
            [
                [
                    'label' => 'Acasă',
                    'url' => '/admin',
                ],
                [
                    'label' => 'Recenzii',
                    'url' => '/admin/main-banner'
                ],
                [
                    'label' => "Informații:  " . Html::encode($model->initials),
                    'url' => ['/admin/main-banner/view', 'id' => $model->id, 'name' => $urlCreator->createUrl($model->initials)]
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
                    'options' => ['class' => 'btn-action btn-success']
                ],

                'view' =>
                [
                    'label' => 'Detalii',
                    'action' => ['view', 'id' => $model->id, 'name' => $urlCreator->createUrl($model->initials)],
                    'icon' => '<span class="material-symbols-outlined">visibility</span>',
                    'options' => ['class' => 'btn-action btn-primary']
                ],

                'delete' =>
                [
                    'label' => 'Șterge',
                    'action' => ['delete', 'id' => $model->id, 'name' => $urlCreator->createUrl($model->initials)],
                    'icon' => Html::tag('span', 'delete', ['class' => 'material-symbols-outlined delete-record-modal']),
                    'options' => ['class' => 'delete-record-modal btn-action btn-danger', 'confirm' => 'Ești sigur că vrei să ștergi această înregistrare: ' . $model->initials]
                ],
            ]
        ])
        ?>

        <?= $this->render('_form', [
            'addForm' => $addForm,
        ]) ?>

    </div>

    <?= ConfirmModal::widget([
        'heading' => 'Confirmă acțiunea',
        'heading_icon' => Html::tag('span', 'error', ['class' => 'material-symbols-outlined']),
        'confirmClass' => 'delete-record-single',
        'data_method' => 'get'
    ]) ?>
</div>