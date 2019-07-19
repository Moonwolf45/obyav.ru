<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 16.11.2017
 * Time: 16:08
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name'); ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Добавить город', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
