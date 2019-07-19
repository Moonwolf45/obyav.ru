<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="category_obyav">
        <h3>Категории</h3>
        <a href="<?= Url::to(['category/create']); ?>" class="btn create_moder">Создать категорию</a>
        <?php if (!empty($all_category)): ?>
            <?php Pjax::begin(); ?>
            <div class="row category_admin">
                <?php foreach ($all_category as $cetegory_one): ?>
                    <div class="block_one" id="<?=$cetegory_one['id']; ?>">
                        <div class="col-lg-10 block_user">
                            <div class="kartinka_categ">
                                <?php $img = $cetegory_one->getImage();?>
                                <?=Html::img($img->getUrl(), ['alt' => $img->urlAlias]);?>
                            </div>
                            <ul class="list-unstyled page_info">
                                <li>Название: <?=$cetegory_one['name']; ?></li>
                                <li>SEO-Ключевики: <?=$cetegory_one['keywords']; ?></li>
                                <li>SEO-Описание: <?=$cetegory_one['description']; ?></li>
                            </ul>
                        </div>
                        <div class="col-lg-2">
                            <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['category/del', 'id' => $cetegory_one['id']]); ?>
                            <?=Html::a(Html::img('@web/images/pencil.svg', ['class' => 'img_block','alt' => 'Редактировать']), ['category/edit', 'id' => $cetegory_one['id']]); ?>
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
            <h2>Категорий не найдено...</h2>
        <?php endif;?>
    </div>
</div>