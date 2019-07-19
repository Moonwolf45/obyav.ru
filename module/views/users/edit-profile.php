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
    <div class="register">
        <?php if(!empty($error_pass)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_pass; ?>
            </div>
        <?php endif; ?>

        <div class="alert alert-warning" role="alert">
            Если вы не желаете менять пароль не вводите их.
        </div>

        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($user, 'name')->label('Имя'); ?>
            <?= $form->field($user, 'email')->label('E-mail'); ?>
            <?= $form->field($user, 'tel')->label('Телефон')->input('tel'); ?>

            <div class="form-group">
                <label for="old_pass">Текущий пароль</label>
                <input type="password" class="form-control" id="old_pass" name="User[old_pass]">
            </div>

            <div class="form-group">
                <label for="new_pass">Новый пароль</label>
                <input type="password" class="form-control" id="new_pass" name="User[new_pass]">
            </div>

            <div class="form-group">
                <label for="confirm_newPass">Повторите новый пароль</label>
                <input type="password" class="form-control" id="confirm_newPass" name="User[conf_new_pass]">
            </div>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Изменить данные', ['class' => 'btn btn-success']) ?>
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
