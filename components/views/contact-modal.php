<?php

use yii\widgets\ActiveForm;


?>

<div class="contact-modal-wrapper d-flex align-items-center justify-content-center modal-wrapper">
    <div class="contact-modal modal-window">
        <div class="loader-modal d-flex align-items-center justify-content-center">
            <img src="<?= Yii::getAlias('@web') ?>\uploads\img\loading-gif.gif" alt="">
        </div>
        <div class="complete-contact d-flex flex-column align-items-center justify-content-center">
            <span class="material-symbols-outlined">
                check_circle
            </span>
            <p>Solicitare dvs. a fost transmisă cu succes!</p>
        </div>

        <div class="modal-header d-flex flex-row justify-content-between align-items-stretch">
            <div class="header-text">
                <h2>Formular de contact</h2>
                <p>Completați formularul pentru a fi contactat!</p>
            </div>
            <span class="material-symbols-outlined closeModal">
                close
            </span>
        </div>
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'options' => [
                'class' => 'modal-body d-flex flex-column align-items-center callback-form resp'
            ],
            'errorCssClass' => '_error-form',
            'successCssClass' => '_success-form'
        ]); ?>



        <?= $form->field($callbackForm, 'initials')->textInput(['placeholder' => $callbackForm->getAttributeLabel('initials')])->label(false) ?>




        <?= $form->field($callbackForm, 'email')->textInput(['placeholder' => $callbackForm->getAttributeLabel('email')])->label(false) ?>

        <?= $form->field($callbackForm, 'phone')->textInput(['placeholder' => $callbackForm->getAttributeLabel('phone')])->label(false) ?>

        <?= $form->field($callbackForm, 'notice')->textarea(['placeholder' => $callbackForm->getAttributeLabel('notice'), 'rows' => '4'])->label(false) ?>


        <button type="submit">Trimite</button>
        <?php ActiveForm::end(); ?>
    </div>

    <!-- <form class="modal-body d-flex flex-column align-items-center callback-form" id="callback-form">
        <input type="text" name='hi' id="hi" placeholder="Nume/Prenume" name="place" />
        <input type="email" name='yes' placeholder="Email" name="hace" />
        <input type="text" name='bles' placeholder="Telefon mobil" name="yess" />
        <button type="button">Trimite</button>
    </form> -->
    <div class="modal-footer"></div>
</div>
</div>