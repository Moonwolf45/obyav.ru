<?php

/** @var $this \yii\web\View */
/** @var $link string */
/** @var $paramExample string */

?>

Уважаемый пользователь!

Вам прислали данное письмо поскольку она была указана при попытке восстановить пароль, если это были не вы проигнорируйте это письмо.
На восстановления пароля у вас есть час, после чего строка будет недействительна.
Ссылка для восстановления пароля: <?php echo $_SERVER['HTTP_ORIGIN']; ?>/site/recovery-pass?recovery_id=<?php echo $this->params['param_id'];?>&recovery_hash=<?php echo $this->params['param_access_hash'];?>

С уважением, администрация сайта NOROF.
Данное письмо сгенерировано автоматически, отвечать на него не надо.
