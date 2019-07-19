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
    <h3>Редактирование: <?php echo $model->name; ?></h3>

    <?php if($model->id == 1): ?>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'keywords'); ?>
        <?= $form->field($model, 'description'); ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Редактировать категорию', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    <?php else: ?>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'name'); ?>

        <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Category::find()->where(['not in', 'id', [1, $model->id]])->all(), 'id', 'name'),
            ['prompt' => 'Самостоятельная категория']
        ); ?>

        <?= $form->field($model, 'keywords'); ?>
        <?= $form->field($model, 'description'); ?>

        <?php $mainImg = $model->getImage(); ?>
        <div class="form-group">
            <?=Html::img($mainImg->getUrl(), ['id' => 'preview_img', 'alt' => 'Превью']); ?>
        </div>
        <?= $form->field($model, 'image')->fileInput(['id' => 'image']) ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Редактировать категорию', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    <?php endif;?>
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