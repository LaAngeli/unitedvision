<?php

use app\modules\admin\components\ActionsButtonsWidget;
use app\modules\admin\components\BreadcrumbsWidget;
use app\modules\admin\components\DetailViewWidget;
use yii\helpers\Html;
use app\helpers\RecordHelper as DataHelper;
use app\helpers\UrlHelper as UrlCreator;
use app\helpers\FileHelper as File;
use app\modules\admin\components\ConfirmModalWidget as ConfirmModal;


$urlCreator = new UrlCreator;
$dataHelper = new DataHelper;


$this->title = "Informații:  " . $model->email;
?>
<div class="grid-wrapper it-wrp">
    <div class="loader-ajax"></div>

    <?= BreadcrumbsWidget::widget([
        'links' =>
        [
            [
                'label' => 'Acasă',
                'url' => '/admin',
            ],
            [
                'label' => 'Utilizatori',
                'url' => '/admin/user'
            ],
            [
                'label' => $this->title,
            ],
        ]
    ])
    ?>

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

            'update' =>
            [
                'label' => 'Actualizare',
                'action' => ['update', 'id' => $model->id, 'email' => $urlCreator->createUrl($model->email)],
                'icon' => '<span class="material-symbols-outlined">edit</span>',
                'options' => ['class' => 'btn-action btn-primary']
            ],

            'delete' =>
            [
                'label' => 'Șterge',
                'action' => ['delete', 'id' => $model->id, 'email' => $urlCreator->createUrl($model->email)],
                'icon' => '<span class="material-symbols-outlined">delete</span>',
                'options' => ['class' => 'delete-record-modal btn-action btn-danger', 'confirm' => 'Ești sigur că vrei să ștergi această înregistrare: ' . $model->email]
            ],
        ]
    ])
    ?>

    <?= DetailViewWidget::widget([
        'model' => $model,
        'attributes' =>
        [
            'id' => [
                'label' => '#ID'
            ],
            'email',
            'lastname',
            'firstname',
            'role' =>
            [
                'label' => 'Rol',
                'value' => Html::tag('b', Html::encode($model->getUserRole()))
            ],
            'status' => [
                'value' => $dataHelper->getStatus(Html::encode($model->status))
            ],
            'updated_at' => [
                'value' => Html::tag('b', Html::encode($model->updated_at)) . '  (' . $dataHelper->dateToTime($model->updated_at) . ' în urmă)'
            ],
            'created_at' => [
                'value' => Html::tag('b', Html::encode($model->created_at)) . '  (' . $dataHelper->dateToTime($model->created_at) . ' în urmă)'
            ],
        ]
    ]) ?>
</div>

<?= ConfirmModal::widget([
    'heading' => 'Confirmă acțiunea',
    'heading_icon' => Html::tag('span', 'error', ['class' => 'material-symbols-outlined']),
    'confirmClass' => 'delete-record-single',
    'data_method' => 'get'
]) ?>