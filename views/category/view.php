<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <?php if (!empty($categorys)): ?>
        <div class="row">
            <div class="menu">
                <?php foreach ($categorys as $category): ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 category">
                        <a href="<?=Url::to(['category/view', 'name' => $category['transliter']]);?>">
                            <?php $img = $category->getImage(); ?>
                            <?=Html::img($img->getUrl(), ['class' => 'category_img', 'alt' => $category['name']]);?>
                            <p class="category_name"><?php echo $category['name'];?></p>
                        </a>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    <?php endif; ?>

    <div class="category_obyav">
        <p class="zagalovok_category"><? echo $cat_name; ?></p>
        <?php if (!empty($adverts_category)): ?>
            <?php Pjax::begin(); ?>
                <?php foreach ($adverts_category as $advert): ?>
                    <div class="obyavlenie">
                        <div class="col-lg-3 kartinka">
                            <a href="<?=Url::to(['advert/view', 'id' => $advert['id']]);?>">
                                <?php $img = $advert->getImage();?>
                                <?=Html::img($img->getUrl(), ['alt' => $advert['name']]);?>
                            </a>
                        </div>
                        <div class="col-lg-9">
                            <p class="obyav_name">
                                <a href="<?=Url::to(['advert/view', 'id' => $advert['id']]);?>">
                                    <?php echo $advert['name'];?>
                                </a>
                            </p>
                            <div class="obyav-info">
                                <?php if (strlen($advert['description']) > 215) {
                                    $desc = trim(mb_substr($advert['description'], 0, 215));
                                    $desc .= "...";
                                    echo $desc;
                                } else {
                                    echo $advert['description'];
                                } ;?>
                            </div>
                            <ul class="list-unstyled list-inline">
                                <li class="list-city"><small class="info_stroka">Город: </small><br><?php echo $advert['city'];?></li>
                                <li class="list-name"><small class="info_stroka">Имя: </small><br><?php echo $advert['user']['name'];?></li>
                                <li class="list-email"><small class="info_stroka">E-mail: </small><br><a href="email:<?php echo $advert['user']['email'];?>"><?php echo $advert['user']['email'];?></a></li>
                                <li class="list-tel"><small class="info_stroka">Телефон: </small><br><a href="tel:<?php echo $advert['user']['tel'];?>"><?php echo $advert['user']['tel'];?></a></li>
                                <li class="list-sum"><small class="info_stroka">Цена: </small><br><?php echo number_format($advert['price'], 2, '.', ' ');?> руб.</li>
                            </ul>
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
            <h2>Здесь пока нет объявлений...</h2>
        <?php endif;?>
    </div>
</div>