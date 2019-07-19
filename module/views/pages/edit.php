<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 16.11.2017
 * Time: 16:08
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

?>

<div class="row">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'title')->label('Название страницы'); ?>
        <?= $form->field($model, 'meta_keywords')->label('SEO-Ключевики'); ?>
        <?= $form->field($model, 'meta_description')->label('SEO-Описание'); ?>
        <?php echo $form->field($model, 'description')->label('Контент')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ]);
        ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Редактировать страницу', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
