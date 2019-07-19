<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="category_obyav">
        <h3 style="float:left;">Модераторы</h3>
        <form action="<?=Url::to(['moderate/filter']); ?>" class="all_filter" method="get" enctype="multipart/form-data">
            <div class="form-group filter_text">
                <input type="text" class="form-control" name="email" placeholder="Фильтрация по имени и e-mail`у">
            </div>
            <button type="submit" class="btn btn-filter">Фильтровать</button>
            <a href="<?=Url::to(['moderate/index']); ?>" class="btn btn-filter">Сбросить</a>
        </form>
        <div class="clearfix"></div>
        <a href="<?= Url::to(['moderate/create']); ?>" class="btn create_moder">Создать модератора</a>
        <?php if (!empty($user)): ?>
            <?php Pjax::begin(); ?>
                <?php foreach ($user as $user_one): ?>
                    <div class="user" id="<?=$user_one['id']; ?>">
                        <div class="col-lg-10 block_user">
                            <ul class="list-unstyled info_moderate">
                                <li>Имя: <?=$user_one['name']; ?></li>
                                <li>E-mail: <?=$user_one['email']; ?></li>
                                <li>Телефон: <?=$user_one['tel']; ?></li>
                            </ul>
                            <a href="<?=Url::to(['moderate/view-adverts', 'id' => $user_one['id']]);?>" class="view_user">Просмотреть объявления</a>
                        </div>
                        <div class="col-lg-2">
                            <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['moderate/del', 'id' => $user_one['id']]); ?>
                            <?php if ($user_one['type'] == 'active'): ?>
                                <?=Html::a(Html::img('@web/images/img_block.png', ['class' => 'img_block','alt' => 'Заблокировать']), ['moderate/block', 'id' => $user_one['id']]); ?>
                            <?php else: ?>
                                <?=Html::a(Html::img('@web/images/img_unblock.png', ['class' => 'img_block','alt' => 'Разблокировать']), ['moderate/unblock', 'id' => $user_one['id']]); ?>
                            <?php endif;?>
                        </div>
                    </div>
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
            <h2>Модераторов не найдено</h2>
        <?php endif;?>
    </div>
</div>