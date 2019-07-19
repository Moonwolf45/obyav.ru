<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="category_obyav">
        <h3>Города</h3>
        <a href="<?= Url::to(['city/create']); ?>" class="btn create_moder">Добавить город</a>
        <?php if (!empty($all_city)): ?>
            <?php Pjax::begin(); ?>
            <div class="row category_admin">
                <?php foreach ($all_city as $сity_one): ?>
                    <div class="col-lg-4">
                        <div class="block" id="<?=$сity_one['id']; ?>">Название: <?php echo $сity_one['name']; ?></div>
                        <div class="ins">
                            <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['city/del', 'id' => $сity_one['id']]); ?>
                            <?=Html::a(Html::img('@web/images/pencil.svg', ['class' => 'img_block','alt' => 'Редактировать']), ['city/edit', 'id' => $сity_one['id']]); ?>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="row">
                <nav class="pagin">
                    <?php echo LinkPager::widget([
                        'pagination' => $pages,
                    ]); ?>
                </nav>
            </div>
            <?php Pjax::end(); ?>
        <?php else: ?>
            <h2>Городов не найдено...</h2>
        <?php endif;?>
    </div>
</div>