<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="banners">
        <h3>Рекламные банеры</h3>
        <a href="<?=Url::to(['advertising/create']); ?>" class="btn create_moder">Добавить баннер</a>
        <?php if (!empty($banners)): ?>
            <?php Pjax::begin(); ?>
            <?php foreach ($banners as $banner_one): ?>
                <div class="user" id="<?=$banner_one['id']; ?>">
                    <div class="col-lg-5 block_user">
                        <h3>Название: <?=$banner_one['name']; ?></h3>
                        <div class="banners_img">
                            <?php $img = $banner_one->getImage(); ?>
                            <?=Html::img($img->getUrl(), ['alt' => $img->urlAlias]);?>
                        </div>
                    </div>
                    <div class="col-lg-5 block_user">
                        <ul class="list-unstyled page_info">
                            <li>Дата создания: <?=$banner_one['date_create']; ?></li>
                            <li>Дата окончания: <?=$banner_one['date_end']; ?></li>
                            <li>Переодичность: <?=$banner_one['periodicity']; ?></li>
                            <li>Категория: <?=$banner_one['category']['name']; ?></li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <?=Html::a(Html::img('@web/images/pencil.svg', ['class' => 'img_block','alt' => 'Редактировать']), ['advertising/edit', 'id' => $banner_one['id']]); ?>
                        <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['advertising/del', 'id' => $banner_one['id']]); ?>
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
            <h2>Баннеры отсутствуют...</h2>
        <?php endif;?>
    </div>
</div>