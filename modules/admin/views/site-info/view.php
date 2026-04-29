<?php

use app\modules\admin\components\ActionsButtonsWidget;
use app\modules\admin\components\BreadcrumbsWidget;
use app\modules\admin\components\DetailViewWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\RecordHelper as DataHelper;
use app\helpers\UrlHelper as UrlCreator;
use app\helpers\FileHelper as File;



$urlCreator = new UrlCreator;
$dataHelper = new DataHelper;


$this->title = "Informații generale";
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
                'label' => $this->title,
            ],
        ]
    ])
    ?>

    <h2><?= Html::encode($this->title) ?></h2>


    <?= ActionsButtonsWidget::widget([
        'buttons' =>
        [
            'update' =>
            [
                'label' => 'Actualizare',
                'action' => ['update'],
                'icon' => '<span class="material-symbols-outlined">edit</span>',
                'options' => ['class' => 'btn-action btn-primary']
            ],

        ]
    ])
    ?>

    <?= DetailViewWidget::widget([
        'model' => $model,
        'attributes' =>
        [
            'site_name',
            'min_description',
            'max_description',
            'logo_footer' => [
                'value' => Html::tag('div', Html::img(Url::to(File::getFile([
                    'filePath' => $model->filePath,
                    'file' => $model->logo_footer
                ])), ['class' => 'modal-img-open', 'loading' => 'lazy']), ['class' => 'detail-wrapper-img']),
            ],
            'logo_header' => [
                'value' => Html::tag('div', Html::img(Url::to(File::getFile([
                    'filePath' => $model->filePath,
                    'file' => $model->logo_header
                ])), ['class' => 'modal-img-open', 'loading' => 'lazy']), ['class' => 'detail-wrapper-img']),
            ],
            'site_image' => [
                'value' => Html::tag('div', Html::img(Url::to(File::getFile([
                    'filePath' => $model->filePath,
                    'file' => $model->site_image
                ])), ['class' => 'modal-img-open', 'loading' => 'lazy']), ['class' => 'detail-wrapper-img']),
            ],
            'phone_number',
            'email',
            'address',
            'map_location' =>
            [
                'value' => '<iframe src="' . $model->map_location . '" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
            ],
            'footer_text',
            'updated_by' =>
            [
                'value' => function ($data) {
                    if ($data->updatedBy !== null) {
                        return Html::encode($data->updatedBy->firstname . ' ' . $data->updatedBy->lastname);
                    } else {
                        return null;
                    }
                }
            ],
            'updated_at' => [
                'value' => Html::tag('b', Html::encode($model->updated_at)) . '  (' . $dataHelper->dateToTime($model->updated_at) . ' în urmă)'
            ]
        ]
    ]) ?>
</div>