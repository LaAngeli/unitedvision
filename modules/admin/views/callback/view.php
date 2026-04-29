<?php

use app\modules\admin\components\ActionsButtonsWidget;
use app\modules\admin\components\BreadcrumbsWidget;
use app\modules\admin\components\DetailViewWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\RecordHelper as DataHelper;
use app\helpers\UrlHelper as UrlCreator;
use app\helpers\FileHelper as File;
use app\helpers\RecordHelper;


$urlCreator = new UrlCreator;
$dataHelper = new DataHelper;


$this->title = "Informații apel:  " . Html::encode($model->initials);
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
                'label' => 'Apel-uri',
                'url' => '/admin/callback'
            ],
            [
                'label' => $this->title,
            ],
        ]
    ])
    ?>

    <h2> <?= Html::encode($this->title) ?></h2>


    <?php if ($model->status === $model::INACTIVE) : ?>
        <?= ActionsButtonsWidget::widget([
            'buttons' =>
            [
                'update' =>
                [
                    'label' => 'Verifiсă',
                    'action' => ['update', 'id' => $model->id, 'initials' => $urlCreator->createUrl($model->initials)],
                    'icon' => '<span class="material-symbols-outlined">edit</span>',
                    'options' => ['class' => 'btn-action btn-primary']
                ],
            ]
        ])
        ?>
    <?php else : ?>

        <h2 class='status-head'>Statut: <?= $dataHelper->getVerify(Html::encode($model->status)); ?></h2>
    <?php endif ?>

    <?= DetailViewWidget::widget([
        'model' => $model,
        'attributes' =>
        [
            'id' => [
                'label' => 'ID'
            ],
            'initials',
            'email' => [
                'value' => Html::a($model->email, 'mailto:' . $model->email)
            ],
            'phone' => [
                'value' =>  Html::a($model->phone, 'tel:' . $model->phone)
            ],
            'notice',
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