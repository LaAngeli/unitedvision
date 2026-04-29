<?php

use yii\widgets\ActiveForm;

$this->title = "Activare cont";
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

        <h5>Crează o parolă</h5>



        <?= $form->field($passwordForm, 'password')->passwordInput(['placeholder' => $passwordForm->getAttributeLabel('password')])->label(false) ?>




        <?= $form->field($passwordForm, 'password_repeat')->passwordInput(['placeholder' => $passwordForm->getAttributeLabel('password_repeat')])->label(false) ?>


        <button type="submit">Finalizează</button>

        <?php ActiveForm::end(); ?>
    </div>
</div>