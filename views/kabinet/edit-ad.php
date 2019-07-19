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
        ['prompt' => 'Выберите категорию'],
        ['options' => ['category_id' => ['selected' => true]]]
    ); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->oldAttributes['id']])->label(false); ?>

    <?php $mainImg = $model->getImage(); ?>
    <div class="form-group">
        <?=Html::img($mainImg->getUrl(), ['id' => 'preview_img', 'alt' => 'Превью']); ?>
    </div>

    <?= $form->field($model, 'image')->fileInput(['id' => 'image']) ?>

    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => 'true', 'accept' => 'image/*']) ?>
    <?php $gallery = $model->getImages(); ?>
    <?php if(count($gallery) > 1): ?>
        <div class="row" style="margin: 0;">
            <?php for ($i = 1; $i < count($gallery); $i++): ?>
                <div class="group_g" id="<?php echo $gallery[$i]->id;?>">
                    <div class="gallery_prev">
                        <?=Html::img($gallery[$i]->getUrl(), ['alt' => $gallery[$i]->urlAlias]); ?>
                        <?=Html::button('X', ['data-href' => '/kabinet/delete-images', 'data-model' => $model->id, 'data-image' => $gallery[$i]->id, 'class' => 'del_gellery']) ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="alert alert-warning" role="alert">
            Что бы удалить картинку галлереи, нажмите на неё.
        </div>
    <?php endif;?>

    <?= $form->field($model, 'name'); ?>

    <?php echo $form->field($model, 'description')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <?= $form->field($model, 'city')->dropDownList(ArrayHelper::map($cities, 'name', 'name'),
        ['prompt' => 'Выберите город'],
        ['options' => ['city' => ['selected' => true]]]
    ); ?>
    <?= $form->field($model, 'price'); ?>

    <?= $form->field($model, 'type')->hiddenInput(['value' => 'moderate'])->label(false); ?>

    <?php $items = ['active' => 'Включено', 'block' => 'Выключено']; ?>
    <?php $param = ['options' => ['adv_active' => ['selected' => true]]]; ?>
    <?= $form->field($model, 'adv_active')->dropDownList($items, $param); ?>

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


        $(".del_gellery").on("click", function (e) {
            e.preventDefault();
            var isTrue = confirm("Удалить изображение?");
            if (isTrue == true) {
                var href = $(this).attr('data-href');
                var id_model = $(this).attr('data-model');
                var image = $(this).attr('data-image');
                $.ajax({
                    type: 'POST',
                    cache: false,
                    url: href + "?id_model=" + id_model + "&image=" + image,
                    success: function(data){
                        console.log(data); // выводим ответ сервера
                        $("#" + image).remove();
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText + '|\n' + status + '|\n' +error);
                    }
                });
            }
        });
    });
</script>
