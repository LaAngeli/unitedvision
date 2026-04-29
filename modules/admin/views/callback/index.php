<?php

use app\modules\admin\components\ActionsButtonsWidget;
use app\modules\admin\components\BreadcrumbsWidget;
use yii\helpers\Html;
use app\modules\admin\components\ListViewWidget as ListView;
use app\helpers\UrlHelper as UrlCreator;
use app\helpers\RecordHelper as DataHelper;



/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lista de cereri';
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

    <?= $this->render('_search_form', [
        'search' => $search,
    ]) ?>

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="table-area">
        <?= $this->render('table_data', [
            'dataProvider' => $dataProvider,
        ]) ?>
    </div>


</div>