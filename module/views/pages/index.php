<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="category_obyav">
        <h3>Правовые документы</h3>
        <a href="<?= Url::to(['pages/create']); ?>" class="btn create_moder">Создать страиницу</a>
        <?php if (!empty($all_page)): ?>
            <?php Pjax::begin(); ?>
            <?php foreach ($all_page as $page_one): ?>
                <div class="user" id="<?=$page_one['id']; ?>">
                    <div class="col-lg-10 block_user">
                        <ul class="list-unstyled page_info">
                            <li>Название: <?=$page_one['title']; ?></li>
                            <li>SEO-Ключевики: <?=$page_one['meta_keywords']; ?></li>
                            <li>SEO-Описание: <?=$page_one['meta_description']; ?></li>
                        </ul>
                        <div class="desc">
                            <?php if (strlen($page_one['description']) > 215) {
                                $desc = trim(mb_substr($page_one['description'], 0, 215));
                                $desc .= "...";
                                echo $desc;
                            } else {
                                echo $page_one['description'];
                            } ;?>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['pages/del', 'id' => $page_one['id']]); ?>
                        <?=Html::a(Html::img('@web/images/pencil.svg', ['class' => 'img_block','alt' => 'Редактировать']), ['pages/edit', 'id' => $page_one['id']]); ?>
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
            <h2>Страниц не найдено...</h2>
        <?php endif;?>
    </div>
</div>