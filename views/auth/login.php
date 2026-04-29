<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = "Logare";
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

        <?php if (Yii::$app->session->hasFlash('passwordReset')) : ?>
            <div class="success-flash"><?= Yii::$app->session->getFlash('passwordReset'); ?></div>
        <?php endif ?>
        <?php if (Yii::$app->session->hasFlash('profileActivated')) : ?>
            <div class="success-flash"><?= Yii::$app->session->getFlash('profileActivated'); ?></div>
        <?php endif ?>
        <?php if (Yii::$app->session->hasFlash('resetSend')) : ?>
            <div class="success-flash"><?= Yii::$app->session->getFlash('resetSend'); ?></div>
        <?php endif ?>

        <h5>Intră în cont</h5>



        <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>




        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>


        <button type="submit">Intră</button>

        <a href="<?= Url::toRoute(['send-password-reset']) ?>" class='fgt'>Parolă uitată?</a>

        <?php ActiveForm::end(); ?>
    </div>
</div>