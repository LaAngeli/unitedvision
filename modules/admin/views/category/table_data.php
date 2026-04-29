<?php

use app\modules\admin\components\ActionsButtonsWidget;
use yii\helpers\Html;
use app\modules\admin\components\ListViewWidget as ListView;
use app\helpers\UrlHelper as UrlCreator;
use app\helpers\RecordHelper as DataHelper;


?>
<div class="loader-ajax"></div>

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
    ]
])
?>


<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'numbering' => [
            'label' => '№',
            'sequential'
        ],
        'results_summary',
        'pages_summary',
        'search_summary'
    ],
    'attributes' =>
    [
        'name',
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
                return ['view', 'id' => $data->id, 'name' => $urlCreator->createUrl($data->name)];
            },
        ],

        'update' =>
        [
            'label' => '<span class="material-symbols-outlined">edit</span>',
            'action' => function ($data) {
                $urlCreator = new UrlCreator;
                return ['update', 'id' => $data->id, 'name' => $urlCreator->createUrl($data->name)];
            },
        ],

        'delete' =>
        [
            'label' => '<span class="material-symbols-outlined">delete</span>',
            'action' => function ($data) {
                $urlCreator = new UrlCreator;
                return ['delete-row', 'id' => $data->id, 'name' => $urlCreator->createUrl($data->name)];
            },
            'options' =>  function ($data) {
                return ['class' => 'delete-record-modal', 'confirm' => 'Ești sigur că vrei să ștergi această înregistrare: ' . $data->name];
            }
        ],

    ]

]) ?>