<?php

use app\helpers\RecordHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\FileHelper as File;
use app\modules\admin\components\ListViewWidget as ListView;
use app\helpers\UrlHelper as UrlCreator;
use app\helpers\RecordHelper as DataHelper;
use app\modules\admin\components\ActionsButtonsWidget;

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
        'pages_summary'
    ],
    'attributes' =>
    [
        'name',
        'image' => [
            'value' => function ($data) {
                return   Html::tag('div', Html::img(Url::to(File::getFile([
                    'filePath' => $data->filePath,
                    'file' => $data->image_desktop
                ])), ['class' => 'modal-img-open', 'loading' => 'lazy']), ['class' => 'list-wrapper-img']);
            }
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
            'options' => [null]
        ],

        'update' =>
        [
            'label' => '<span class="material-symbols-outlined">edit</span>',
            'action' => function ($data) {
                $urlCreator = new UrlCreator;
                return ['update', 'id' => $data->id, 'name' => $urlCreator->createUrl($data->name)];
            },
            'options' => [null]
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