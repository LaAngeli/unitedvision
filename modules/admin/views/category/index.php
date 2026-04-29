<?php


use app\modules\admin\components\BreadcrumbsWidget;
use yii\helpers\Html;
use app\modules\admin\components\ConfirmModalWidget as ConfirmModal;


$this->title = 'Lista de categorii';
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



    <?= ConfirmModal::widget([
        'heading' => 'Confirmă acțiunea',
        'heading_icon' => Html::tag('span', 'error', ['class' => 'material-symbols-outlined']),
        'confirmClass' => 'delete-row-table',
        'data_method' => 'get'
    ]) ?>






</div>