<?php

use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="menu">
        <?php $cache_category = Yii::$app->cache->get('cache_category');
        if ($cache_category) {
            $categorys = $cache_category;
        } else {
            $categorys = Category::find()->where(['not in', 'id', 1])->andWhere(['parent_id' => 0])->orderBy('name')->all();
            // Записываем в кэш
            Yii::$app->cache->set('cache_category', $categorys, 60);
        } ?>
        <?php foreach ($categorys as $category): ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 category">
                <a href="<?=Url::to(['category/view', 'name' => $category['transliter']]);?>">
                    <?php $img = $category->getImage(); ?>
                    <?=Html::img($img->getUrl(), ['class' => 'category_img', 'alt' => $category['name']]);?>
                    <p class="category_name"><?php echo $category['name'];?></p>
                </a>
            </div>
        <?php endforeach;?>
        <img class="banner" src="../images/banner_1.jpg" alt="Баннер_1">
    </div>

    <div class="gor_obyav">
        <p class="zagalovok">Горячие объявление</p>
        <form action="<?=Url::to(['category/search']); ?>" class="all_search" method="get" enctype="multipart/form-data">
            <div class="form-group select">
                <select class="form-control" name="cat">
                    <option value="">По категории</option>
                    <?php $cache_category_search = Yii::$app->cache->get('cache_category_search');
                    if ($cache_category_search) {
                        $categorys_s = $cache_category_search;
                    } else {
                        $categorys_s = Category::find()->orderBy('name')->asArray()->all();
                        // Записываем в кэш
                        Yii::$app->cache->set('cache_category_search', $categorys_s, 60);
                    } ?>
                    <?php foreach ($categorys_s as $category): ?>
                        <?php if ($category['id'] != 1 || $category['name'] != "Главная страница"): ?>
                            <option value="<?=$category['id'];?>"><?php echo $category['name'];?></option>
                        <?php endif; ?>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group search_text">
                <input type="text" class="form-control" name="q" placeholder="По названию">
            </div>
            <button type="submit" class="btn btn-search">Поиск</button>
        </form>

        <?php if (!empty($adverts)): ?>
            <?php Pjax::begin(); ?>
                <?php foreach ($adverts as $advert): ?>
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
            <h2>В вашем городе пока нет объявлений...</h2>
        <?php endif;?>
    </div>
</div>