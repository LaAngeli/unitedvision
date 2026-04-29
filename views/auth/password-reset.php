<?php

use yii\widgets\ActiveForm;

$this->title = "Resetare parolă";
?>


<div class="container">
    <div class="form-wrapper-acc d-flex align-items-center justify-content-center">
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'options' => [
                'class' => 'modal-body d-flex flex-column align-items-center resp'
            ],
            'errorCssClass' => '_error-form',
            'successCssClass' => '_success-form'
        ]); ?>

        <h5>Resetare parolă</h5>



        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>




        <?= $form->field($model, 'confirm_password')->passwordInput(['placeholder' => $model->getAttributeLabel('confirm_password')])->label(false) ?>


        <button type="submit">Finalizează</button>

        <?php ActiveForm::end(); ?>
    </div>
</div>