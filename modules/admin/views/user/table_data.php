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
        'email',
        'firstname',
        'lastname',
        'status' => [
            'value' => function ($data) {
                $dataHelper = new DataHelper;
                return $dataHelper->getStatus(Html::encode($data->status));
            }
        ],
        'role' =>
        [
            'label' => 'Rol',
            'value' => function ($data) {
                return Html::tag('b', Html::encode($data->getUserRole()));
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
                return ['view', 'id' => $data->id, 'email' => $urlCreator->createUrl($data->email)];
            },
            'options' => [null]
        ],

        'update' =>
        [
            'label' => '<span class="material-symbols-outlined">edit</span>',
            'action' => function ($data) {
                $urlCreator = new UrlCreator;
                return ['update', 'id' => $data->id, 'email' => $urlCreator->createUrl($data->email)];
            },
            'options' => [null]
        ],

        'delete' =>
        [
            'label' => '<span class="material-symbols-outlined">delete</span>',
            'action' => function ($data) {
                $urlCreator = new UrlCreator;
                return ['delete-row', 'id' => $data->id, 'email' => $urlCreator->createUrl($data->email)];
            },
            'options' =>  function ($data) {
                return ['class' => 'delete-record-modal', 'confirm' => 'Ești sigur că vrei să ștergi această înregistrare: ' . $data->email];
            }
        ],

    ]

]) ?>