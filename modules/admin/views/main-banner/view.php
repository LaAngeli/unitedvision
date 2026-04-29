<?php

use app\modules\admin\components\ActionsButtonsWidget;
use app\modules\admin\components\BreadcrumbsWidget;
use app\modules\admin\components\DetailViewWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\RecordHelper as DataHelper;
use app\helpers\UrlHelper as UrlCreator;
use app\helpers\FileHelper as File;
use app\modules\admin\components\ConfirmModalWidget as ConfirmModal;


$urlCreator = new UrlCreator;
$dataHelper = new DataHelper;


$this->title = "Informații banner:  " . Html::encode($model->name);
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
                'label' => 'Bannere',
                'url' => '/admin/main-banner'
            ],
            [
                'label' => $this->title,
            ],
        ]
    ])
    ?>

    <h2> <?= Html::encode($this->title) ?></h2>

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
                'action' => ['update', 'id' => $model->id, 'name' => $urlCreator->createUrl($model->name)],
                'icon' => '<span class="material-symbols-outlined">edit</span>',
                'options' => ['class' => 'btn-action btn-primary']
            ],

            'delete' =>
            [
                'label' => 'Șterge',
                'action' => ['delete', 'id' => $model->id, 'name' => $urlCreator->createUrl($model->name)],
                'icon' => Html::tag('span', 'delete', ['class' => 'material-symbols-outlined delete-record-modal']),
                'options' => ['class' => 'delete-record-modal btn-action btn-danger', 'confirm' => 'Ești sigur că vrei să ștergi această înregistrare: ' . $model->name]
            ],
        ]
    ])
    ?>


    <?= DetailViewWidget::widget([
        'model' => $model,
        'attributes' =>
        [
            'id' => [
                'label' => 'ID'
            ],
            'name',
            'url' => [
                'value' => function ($data) {

                    return Html::a(
                        Html::encode($data->url) .
                            Html::tag('span', 'link', ['class' => 'material-symbols-outlined']),
                        Url::to($data->url, true)
                    );
                }
            ],
            'image_desktop' => [
                'value' => Html::tag('div', Html::img(Url::to(File::getFile([
                    'filePath' => $model->filePath,
                    'file' => $model->image_desktop
                ])), ['class' => 'modal-img-open', 'loading' => 'lazy']), ['class' => 'detail-wrapper-img']),
            ],
            'image_mobile' => [
                'value' => Html::tag('div', Html::img(Url::to(File::getFile([
                    'filePath' => $model->filePath,
                    'file' => $model->image_mobile
                ])), ['class' => 'modal-img-open', 'loading' => 'lazy']), ['class' => 'detail-wrapper-img']),
            ],
            'status' => [
                'value' => function ($data) {
                    $dataHelper = new DataHelper;
                    return $dataHelper->getStatus(Html::encode($data->status));
                }
            ],
            'updated_by' => [
                'value' => function ($data) {
                    if ($data->updatedBy !== null) {
                        return Html::tag('b', Html::encode($data->updatedBy->firstname) . ' ' . Html::encode($data->updatedBy->lastname));
                    } else {
                        return null;
                    }
                }
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