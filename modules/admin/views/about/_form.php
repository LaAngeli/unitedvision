<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\FileHelper as Image;
?>



<?php $form = ActiveForm::begin([

    'options' => [
        'enctype' => 'multipart/form-data',
        'class' => 'd-flex flex-column align-items-baseline'
    ],
    'errorCssClass' => '_error-form',
    'successCssClass' => '_success-form'
]); ?>



<?= $form->field($addForm, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'description_min')->textarea(['rows' => '6']) ?>

<?= $form->field($addForm, 'description_max')->textarea(['rows' => '6']) ?>

<?= Html::activeLabel($addForm, 'image', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-1'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->image
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-1" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'image')->fileInput(['id' => 'upload-image-inp-1', 'class' => 'inp-hidden'])->label(false) ?>
</div>


<?= $form->field($addForm, 'status')->dropDownList(
    [$addForm::ACTIVE => 'Activ', $addForm::INACTIVE => 'Inactiv'],
    ['prompt' => 'Selectează statut']

); ?>


<div class="form-group">
    <?= Html::submitButton('Salvează', ['class' => 'btn btn-success']) ?>
</div>



<?php ActiveForm::end(); ?>