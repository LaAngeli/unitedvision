<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;




/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>



<?php $form = ActiveForm::begin([
    'method' => 'get',
    'action' => '/admin/user/search',

    'options' => [
        'class' => 'd-flex flex-column resp search-form-admin'
    ],
    'errorCssClass' => '_error-form',
    'successCssClass' => '_success-form'
]); ?>

<h4>Сăutare</h4>

<div class="d-flex flex-row justify-contetn-around">

    <div class="frm-section d-flex flex-column">
        <?= $form->field($search, 'email')->textInput(['placeholder' => $search->getAttributeLabel('email')]) ?>
    </div>
</div>


<div class="form-group">
    <?= Html::submitButton('Căutare', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>