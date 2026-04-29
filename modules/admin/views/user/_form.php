<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

?>



<?php $form = ActiveForm::begin([

    'options' => [
        'enctype' => 'multipart/form-data',
        'class' => 'd-flex flex-column align-items-baseline'
    ],
    'errorCssClass' => '_error-form',
    'successCssClass' => '_success-form'
]); ?>


<?= $form->field($addForm, 'lastname')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'firstname')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'email_repeat')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'role')->dropdownList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'), ['prompt' => 'Selectează rol']); ?>


<div class="form-group">
    <?= Html::submitButton('Salvează', ['class' => 'btn btn-success']) ?>
</div>



<?php ActiveForm::end(); ?>