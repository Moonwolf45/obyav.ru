<?php

/** @var $this \yii\web\View */
/** @var $link string */
/** @var $paramExample string */

?>

<p>
    Уважаемый пользователь!<br>
    <br>
    Вам прислали данное письмо поскольку она была указана при попытке восстановить пароль, если это были не вы проигнорируйте это письмо.<br>
    На восстановления пароля у вас есть час, после чего строка будет недействительна.<br>
    Ссылка для восстановления пароля: <?php echo $_SERVER['HTTP_ORIGIN']; ?>/site/recovery-pass?recovery_id=<?php echo $this->params['param_id'];?>&recovery_hash=<?php echo $this->params['param_access_hash'];?><br>
    <br>
    С уважением, администрация сайта NOROF.<br>
    <span style="font-size:10px;color:#666;">Данное письмо сгенерировано автоматически, отвечать на него не надо.</span>
</p>
