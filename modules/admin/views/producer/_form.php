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

<?= $form->field($addForm, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($addForm, 'description_min')->textarea(['class' => 'txt-editor']) ?>

<?= $form->field($addForm, 'description_max')->textarea(['class' => 'txt-editor']) ?>

<?= $form->field($addForm, 'video_url')->textInput(['maxlength' => true]) ?>


<?= Html::activeLabel($addForm, 'image_logo', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-1'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->image_logo
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-1" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'image_logo')->fileInput(['id' => 'upload-image-inp-1', 'class' => 'inp-hidden'])->label(false) ?>
</div>


<?= Html::activeLabel($addForm, 'image_brand', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-2'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->image_brand
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-2" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'image_brand')->fileInput(['id' => 'upload-image-inp-2', 'class' => 'inp-hidden'])->label(false) ?>
</div>


<?= Html::activeLabel($addForm, 'image_slider_big', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-3'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->image_slider_big
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-3" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'image_slider_big')->fileInput(['id' => 'upload-image-inp-3', 'class' => 'inp-hidden'])->label(false) ?>
</div>

<?= Html::activeLabel($addForm, 'image_slider_small', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-4'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->image_slider_small
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-4" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'image_slider_small')->fileInput(['id' => 'upload-image-inp-4', 'class' => 'inp-hidden'])->label(false) ?>
</div>


<?= Html::activeLabel($addForm, 'image_video_preview', ['class' => 'img-upload-label'])  ?>
<div class="img-upload-wrapper d-flex flex-column align-items-center " data-prev='upload-image-inp-5'>
    <div class="prev-area d-flex flex-row flex-wrap align-items-center justify-content-center ">
        <div class="preview">
            <img id="img-upload-preview" class="img-upload-preview" src="<?= Image::getFile([
                                                                                'filePath' => $addForm->filePath,
                                                                                'file' => $addForm->image_video_preview
                                                                            ]) ?>">
            <p class="file-name-preview"></p>
        </div>
    </div>
    <label for="upload-image-inp-5" class="img-input-click"><span>Încarcă Fișier</span><span class="material-symbols-outlined icon">cloud_upload</span></label>
    <?= $form->field($addForm, 'image_video_preview')->fileInput(['id' => 'upload-image-inp-5', 'class' => 'inp-hidden'])->label(false) ?>
</div>

<label class='br-area'>Producător/Brand</label>
<div class="checkbox-area d-flex flex-row flex-wrap">


    <?php if (isset($brandIn)) : ?>
        <?php foreach ($brandIn as $in) : ?>
            <div class="filter-item d-flex flex-row align-items-center justify-content-center ">
                <label class="filter-name" for='pr-name<?= Html::encode($in->id) ?>'> <b><?= Html::encode($in->name) ?> </b> </label>
                <input type="checkbox" name="<?= (new ReflectionClass($addForm))->getShortName() ?>[categories][]" id='pr-name<?= Html::encode($in->id) ?>' value="<?= $in->id ?>" checked>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <?php if (isset($brandNot)) : ?>
        <?php foreach ($brandNot as $not) : ?>
            <div class="filter-item d-flex flex-row align-items-center justify-content-center  ">
                <label class="filter-name" for='pr-name<?= Html::encode($not->id) ?>'><b><?= Html::encode($not->name) ?> </b></label>
                <input type="checkbox" name="<?= (new ReflectionClass($addForm))->getShortName() ?>[categories][]" id='pr-name<?= Html::encode($not->id) ?>' value="<?= $not->id ?>">
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>





<?= $form->field($addForm, 'status')->dropDownList(
    [$addForm::ACTIVE => 'Activ', $addForm::INACTIVE => 'Inactiv'],
    ['prompt' => 'Selectează statut']

); ?>



<div class="form-group">
    <?= Html::submitButton('Salvează', ['class' => 'btn btn-success']) ?>
</div>



<?php ActiveForm::end(); ?>