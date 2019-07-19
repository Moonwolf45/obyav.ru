<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="category_obyav">
        <?php if (!empty($adverts_all)): ?>
            <?php Pjax::begin(); ?>
            <?php foreach ($adverts_all as $advert): ?>
                <div class="obyavlenie" id="<?=$advert['id']; ?>">
                    <div class="col-lg-3 kartinka">
                        <a href="<?=Url::to(['moderate/adverts', 'id' => $advert['id']]);?>">
                            <?=Html::img('@web/images/advert/'.$advert['images'], ['alt' => $advert['name']]);?>
                        </a>
                    </div>
                    <div class="col-lg-9">
                        <p class="obyav_name">
                            <a href="<?=Url::to(['moderate/adverts', 'id' => $advert['id']]);?>">
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
                            <li class="list-admin-city"><?php echo $advert['city'];?></li>
                            <li class="list-admin-name"><?php echo $advert['user']['name'];?></li>
                            <li class="list-admin-email"><a href="email:<?php echo $advert['user']['email'];?>"><?php echo $advert['user']['email'];?></a></li>
                            <li class="list-admin-tel"><a href="tel:<?php echo $advert['user']['tel'];?>"><?php echo $advert['user']['tel'];?></a></li>
                            <li class="list-admin-sum"><?php echo number_format($advert['price'], 2, '.', ' ');?> руб.</li>
                            <?php if ($advert['type'] == "active"): ?>
                                <li class="list-admin-status"><p class="text-success">Активное</p></li>
                            <?php elseif ($advert['type'] == "blocked"): ?>
                                <li class="list-admin-status"><p class="text-danger">Заблокировано</p></li>
                            <?php elseif ($advert['type'] == "moderate"): ?>
                                <li class="list-admin-status"><p class="text-info">На модерации</p></li>
                            <?php endif; ?>
                            <?php if ($advert['adv_active'] == "active"): ?>
                                <li class="status-us"><p class="text-success">Включено</p></li>
                            <?php else: ?>
                                <li class="status-us"><p class="text-danger">Выключено</p></li>
                            <?php endif; ?>
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
            <h2>У данного модератора нет объявлений...</h2>
        <?php endif;?>
    </div>
</div>