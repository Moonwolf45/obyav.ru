<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 16.11.2017
 * Time: 16:08
 */

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name'); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->where(['not in', 'id', 1])->all(), 'id', 'name'),
        ['prompt' => 'Выберите категорию']
    ); ?>

    <?php $mainImg = $model->getImage(); ?>
    <div class="form-group">
        <?=Html::img($mainImg->getUrl(), ['id' => 'preview_banner', 'alt' => 'Превью']); ?>
    </div>
    <?= $form->field($model, 'image')->fileInput(['id' => 'image']); ?>

    <?= $form->field($model, 'periodicity')->dropDownList(['3' => 'Каждые 3 объявления', '5' => 'Каждые 5 объявлений']); ?>

    <?= $form->field($model, 'term')->input('number');;?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Создать баннер', ['class' => 'btn btn-success']) ?>
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
                    var img = document.getElementById("preview_banner");
                    img.src = e.target.result;
                };
            })(f);
            reader.readAsDataURL(f);
        }
        document.getElementById('image').addEventListener('change', handleFileSelect, false);
    });
</script>