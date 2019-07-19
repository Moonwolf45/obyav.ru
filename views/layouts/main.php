<?php

use app\models\Category;
use app\models\Pages;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\assets\ltAppAsset;

AppAsset::register($this);
ltAppAsset::register($this);

$ip = Yii::$app->geoip->ip(); // current user ip
$arrIP['ip'] = $ip; // необязательно

$ip->city; // "San Francisco"
$arrIP['city'] = $ip->city; // необязательно

$session = Yii::$app->session;
if ($session->isActive) {
    $_SESSION['city'] = $ip->city;
} else {
    $session->open();
    $_SESSION['city'] = $ip->city;
}

$ip->country; // "United States"
$arrIP['country'] = $ip->country; // необязательно

$ip->location->lng; // 37.7898
$arrIP['location_lng'] = $ip->location->lng; // необязательно

$ip->location->lat; // -122.3942
$arrIP['location_lat'] = $ip->location->lat; // необязательно

$ip->isoCode;
$arrIP['isoCode'] = $ip->isoCode; // необязательно
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; <?=Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?=Html::csrfMetaTags(); ?>
    <title><?=Html::encode($this->title); ?></title>
    <?php $this->head(); ?>

    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
<?php $this->beginBody(); ?>
    <header>
        <div class="container">
            <a href="<?=Url::home(); ?>" class="logo">
                <?=Html::img('@web/images/logo.svg', ['alt' => 'Лого']); ?>
            </a>
            <div class="block_right">
                <div class="row">
                    <div class="city"><span>Москва</span></div>
                    <a href="<?=Url::to(['kabinet/index']);?>" class="btn add_ob">Разместить объявление</a>
                </div>
                <div class="row">
                    <form action="<?=Url::to(['category/search']); ?>" class="all_search" method="get" enctype="multipart/form-data">
                        <div class="form-group select">
                            <select class="form-control" name="cat">
                                <option value="">По категории</option>
                                <?php $cache_category_search = Yii::$app->cache->get('cache_category_search');
                                if ($cache_category_search) {
                                    $categorys_s = $cache_category_search;
                                } else {
                                    $categorys_s = Category::find()->where(['not in', 'id', 1])->orderBy('name')->asArray()->all();
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
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <?php debug($arrIP); ?>
            <?php echo $content;?>
        </div>
    </main>

    <footer>
        <div class="container">
            <?php $cache_pages = Yii::$app->cache->get('cache_pages');
            if ($cache_pages) {
                $page_all = $cache_pages;
            } else {
                $page_all = Pages::find()->asArray()->all();
                // Записываем в кэш
                Yii::$app->cache->set('cache_pages', $page_all, 60);
            } ?>
            <ul class="list-unstyled menu_footer">
                <?php foreach ($page_all as $page): ?>
                    <li><a href="<?=Url::to(['/pages/view', 'name' => $page['transliter']]);?>"><?php echo $page['title']; ?></a></li>
                <?php endforeach;?>
            </ul>
            <ul class="list-unstyled menu_footer">
                <li><a href="<?=Url::home(); ?>">Главная</a></li>
                <?php $cat = array_chunk($categorys_s, count($categorys_s)/2); ?>

                <?php foreach ($cat[0] as $category): ?>
                    <?php if ($category['transliter'] != "Glavnaya_stranica" || $category['name'] != "Главная страница"): ?>
                        <li><a href="<?=Url::to(['category/view', 'name' => $category['transliter']]);?>"><?php echo $category['name'];?></a></li>
                    <?php endif; ?>
                <?php endforeach;?>
            </ul>
            <ul class="list-unstyled menu_footer">
                <?php foreach ($cat[1] as $category): ?>
                    <?php if ($category['transliter'] != "Glavnaya_stranica" || $category['name'] != "Главная страница"): ?>
                        <li><a href="<?=Url::to(['category/view', 'name' => $category['transliter']]);?>"><?php echo $category['name'];?></a></li>
                    <?php endif; ?>
                <?php endforeach;?>
            </ul>
            <a href="<?=Url::to(['kabinet/index']);?>" class="add_footer">Разместить объявление</a>
            <a href="<?=Url::home(); ?>" class="logo_footer">
                <?=Html::img('@web/images/logo-white.svg', ['alt' => 'Лого футер']); ?>
            </a>
        </div>
    </footer>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>