<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="category_obyav">
        <h3 style="float:left;">Пользователи</h3>
        <form action="<?=Url::to(['users/filter']); ?>" class="all_filter" method="get" enctype="multipart/form-data">
            <div class="form-group filter_text">
                <input type="text" class="form-control" name="email" placeholder="Фильтрация по имени и e-mail`у">
            </div>
            <button type="submit" class="btn btn-filter">Фильтровать</button>
            <a href="<?=Url::to(['moderate/index']); ?>" class="btn btn-filter">Сбросить</a>
        </form>
        <div class="clearfix"></div>
        <?php if (!empty($users)): ?>
            <?php Pjax::begin(); ?>
            <?php foreach ($users as $user_one): ?>
                <?php if($user_one['id'] != 1): ?>
                    <div class="user" id="<?=$user_one['id']; ?>">
                        <div class="col-lg-10 block_user">
                            <ul class="list-unstyled info_moderate">
                                <li>Имя: <?=$user_one['name']; ?></li>
                                <li>E-mail: <?=$user_one['email']; ?></li>
                                <li>Телефон: <?=$user_one['tel']; ?></li>
                            </ul>
                            <ul class="list-unstyled info_moderate">
                                <?php if ($user_one['role'] == 'moderated'): ?>
                                    <li>Роль: <p class="text-info">Модератор</p></li>
                                <?php elseif ($user_one['role'] == 'user'): ?>
                                    <li>Роль: <p class="text-success">Ползователь</p></li>
                                <?php endif; ?>
                                <?php if ($user_one['type'] == 'active'): ?>
                                    <li>Статус: <p class="text-success">Активный</p></li>
                                <?php elseif ($user_one['type'] == 'blocked'): ?>
                                    <li>Статус: <p class="text-danger">Заблокирован</p></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="col-lg-2">
                            <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['users/del', 'id' => $user_one['id']]); ?>
                            <?php if ($user_one['type'] == 'active'): ?>
                                <?=Html::a(Html::img('@web/images/img_block.png', ['class' => 'img_block','alt' => 'Заблокировать']), ['users/block', 'id' => $user_one['id']]); ?>
                            <?php else: ?>
                                <?=Html::a(Html::img('@web/images/img_unblock.png', ['class' => 'img_block','alt' => 'Разблокировать']), ['users/unblock', 'id' => $user_one['id']]); ?>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach;?>
            <div class="row">
                <nav class="pagin">
                    <?php echo LinkPager::widget([
                        'pagination' => $pages,
                    ]); ?>
                </nav>
            </div>
            <?php Pjax::end(); ?>
        <?php else: ?>
            <h2>Пользователей не найдено</h2>
        <?php endif;?>
    </div>
</div>