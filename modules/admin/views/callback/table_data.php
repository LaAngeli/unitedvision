<?php

use yii\helpers\Html;
use app\modules\admin\components\ListViewWidget as ListView;
use app\helpers\UrlHelper as UrlCreator;
use app\helpers\RecordHelper as DataHelper;


?>
<div class="loader-ajax"></div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'numbering' => [
            'label' => '№',
            'sequential'
        ],
        'results_summary',
        'search_summary',
        'pages_summary'
    ],
    'attributes' =>
    [
        'initials',
        'email' => [
            'value' => function ($data) {
                return Html::a($data->email, 'mailto:' . $data->email);
            }
        ],
        'phone' => [
            'value' => function ($data) {
                return Html::a($data->phone, 'tel:' . $data->phone);
            }
        ],
        'status' => [
            'value' => function ($data) {
                $dataHelper = new DataHelper;
                if ($data->status === $data::INACTIVE) {
                    return Html::a('Verifică', ['update', 'id' => $data->id], ['class' => 'verify-record table-status', 'method' => 'POST']);
                } else {
                    return Html::tag('b', $dataHelper->getVerify(Html::encode($data->status)));
                }
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
            'value' => function ($data) {
                $dataHelper = new DataHelper;
                return Html::tag('b', Html::encode($data->updated_at)) . '<br>  ' . Html::tag('p', $dataHelper->dateToTime($data->updated_at) . ' în urmă', ['class' => 'show-ago']);
            }
        ],
    ],
    'buttons' =>
    [

        'view' =>
        [
            'label' => '<span class="material-symbols-outlined">visibility</span>',
            'action' => function ($data) {
                $urlCreator = new UrlCreator;
                return ['view', 'id' => $data->id, 'initials' => $urlCreator->createUrl($data->initials)];
            }
        ],
    ]

]) ?>