<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 16.11.2017
 * Time: 16:08
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>

<div class="row">
    <div class="register">
        <h1>Регистрация</h1>

        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'name'); ?>
        <?= $form->field($model, 'email'); ?>
        <?= $form->field($model, 'tel')->input('tel'); ?>
        <?= $form->field($model, 'password')->passwordInput(); ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput(); ?>
        <div class="form-group">
            <div>
                <?= Html::submitButton('Зарегестрироватсья', ['class' => 'btn btn-success']); ?>
                <a href="<?=Url::to(['site/login']); ?>" class="btn btn-primary">Авторизация</a>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('input[type="tel"]').inputmask("phone", {
            onKeyValidation: function () {
                console.log($(this).inputmask("getmetadata")["city"]);
            }
        });
    })
</script>
