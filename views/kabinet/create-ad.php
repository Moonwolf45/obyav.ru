<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 16.11.2017
 * Time: 16:08
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

mihaildev\elfinder\Assets::noConflict($this);

?>

<div class="row">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($category, 'id', 'name'),
            ['prompt' => 'Выберите категорию']
        ); ?>
        <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->oldAttributes['id']])->label(false); ?>
        <div class="form-group">
            <?=Html::img( '@web/images/advert/no_photo.png', ['id' => 'preview_img', 'alt' => 'Превью']); ?>
        </div>

        <?= $form->field($model, 'image')->fileInput(['id' => 'image']) ?>
        <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => 'true', 'accept' => 'image/*']) ?>
        <?= $form->field($model, 'name'); ?>

        <?php echo $form->field($model, 'description')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ]); ?>

        <?= $form->field($model, 'city')->dropDownList(ArrayHelper::map($cities, 'name', 'name'),
            ['prompt' => 'Выберите город']
        ); ?>
        <?= $form->field($model, 'price'); ?>

        <?= $form->field($model, 'type')->hiddenInput(['value' => 'moderate'])->label(false); ?>
        <?= $form->field($model, 'adv_active')->hiddenInput(['value' => 'active'])->label(false); ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Создать оъявление', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        function handleFileSelect(evt) {
            var file = evt.target.files;
            var f = file[0];
            if (!f.type.match('image.*')) {
                alert("Данный файл не изображение!!!");
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    var img = document.getElementById("preview_img");
                    img.src = e.target.result;
                };
            })(f);
            reader.readAsDataURL(f);
        }
        document.getElementById('image').addEventListener('change', handleFileSelect, false);
    });
</script>
