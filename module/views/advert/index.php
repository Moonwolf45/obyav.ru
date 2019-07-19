<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="category_obyav">
        <h3 style="float:left;">Объявления</h3>
        <form action="<?=Url::to(['advert/filter']); ?>" class="all_filter" method="get" enctype="multipart/form-data">
            <div class="form-group filter">
                <select class="form-control" name="city">
                    <option value="">Все города</option>
                    <?php foreach ($city as $сity_one): ?>
                        <option value="<?php echo $сity_one['name'];?>" <?php if ($_SESSION['city'] == $сity_one['name']) echo "selected"; ?>><?php echo $сity_one['name'];?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <button type="submit" class="btn btn-filter">Фильтровать</button>
        </form>
        <?php if (!empty($adverts_category)): ?>
            <?php Pjax::begin(); ?>
            <?php foreach ($adverts_category as $advert): ?>
                <div class="obyavlenie" id="<?=$advert['id']; ?>">
                    <div class="col-lg-3 kartinka">
                        <a href="<?=Url::to(['advert/view', 'id' => $advert['id']]);?>">
                            <?php $img = $advert->getImage(); ?>
                            <?=Html::img($img->getUrl(), ['alt' => $advert['name']]);?>
                        </a>
                    </div>
                    <div class="col-lg-6">
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
                            <li class="list-admin-city"><small class="info_stroka">Город: </small><?php echo $advert['city'];?></li>
                            <li class="list-admin-name"><small class="info_stroka">Имя: </small><?php echo $advert['user']['name'];?></li>
                            <li class="list-admin-email"><small class="info_stroka">E-mail: </small><a href="email:<?php echo $advert['user']['email'];?>"><?php echo $advert['user']['email'];?></a></li>
                            <li class="list-admin-tel"><small class="info_stroka">Телефон: </small><a href="tel:<?php echo $advert['user']['tel'];?>"><?php echo $advert['user']['tel'];?></a></li>
                            <li class="list-admin-sum"><small class="info_stroka">Цена: </small><?php echo number_format($advert['price'], 2, '.', ' ');?> руб.</li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <?= Html::a('Принять', ['advert/active', 'id' => $advert['id']], ['class' => 'btn btn_type_active']); ?>
                        <?= Html::a('Отклонить', ['advert/blocked', 'id' => $advert['id']], ['class' => 'btn btn_type_blocked']); ?>
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
            <h2>В этом городе нет объявлений на модерацию...</h2>
        <?php endif;?>
    </div>
</div>