<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\FileHelper as Image;


/** @var yii\web\View $this */
/** @var app\models\tour\Tour $model */
/** @var yii\widgets\ActiveForm $form */
?>



<?php $form = ActiveForm::begin([

    'options' => [
        'enctype' => 'multipart/form-data',
        'class' => 'd-flex flex-column align-items-baseline'
    ],
    'errorCssClass' => '_error-form',
    'successCssClass' => '_success-form'
]); ?>

<?= $form->field($addForm, 'site_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'min_description')->textarea(['rows' => '7']) ?>

<?= $form->field($addForm, 'max_description')->textarea(['rows' => '7']) ?>




<?= Html::activeLabel($addForm, 'logo_header', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-1'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->logo_header
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-1" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'logo_header')->fileInput(['id' => 'upload-image-inp-1', 'class' => 'inp-hidden'])->label(false) ?>
</div>


<?= Html::activeLabel($addForm, 'logo_footer', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-2'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->logo_footer
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-2" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'logo_footer')->fileInput(['id' => 'upload-image-inp-2', 'class' => 'inp-hidden'])->label(false) ?>
</div>


<?= Html::activeLabel($addForm, 'site_image', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-3'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->site_image
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-3" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'site_image')->fileInput(['id' => 'upload-image-inp-3', 'class' => 'inp-hidden'])->label(false) ?>
</div>


<?= $form->field($addForm, 'footer_text')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'phone_number')->textInput() ?>

<?= $form->field($addForm, 'email')->textInput() ?>

<?= $form->field($addForm, 'address')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'map_location')->textInput(['maxlength' => true]) ?>


<div class="form-group">
    <?= Html::submitButton('Salvează', ['class' => 'btn btn-success']) ?>
</div>



<?php ActiveForm::end(); ?>