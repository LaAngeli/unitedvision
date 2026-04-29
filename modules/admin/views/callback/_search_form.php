<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;




/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>



<?php $form = ActiveForm::begin([
    'method' => 'get',
    'action' => '/admin/callback/search',

    'options' => [
        'class' => 'd-flex flex-column resp search-form-admin'
    ],
    'errorCssClass' => '_error-form',
    'successCssClass' => '_success-form'
]); ?>

<h4>Сăutare</h4>

<div class="d-flex flex-row justify-contetn-around">

    <div class="frm-section d-flex flex-column">
        <?= $form->field($search, 'initials')->textInput(['placeholder' => $search->getAttributeLabel('initials')]) ?>
        <?= $form->field($search, 'limit')->textInput(['placeholder' => 'Afișări pe pagină']) ?>
    </div>
</div>


<div class="form-group">
    <?= Html::submitButton('Căutare', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>