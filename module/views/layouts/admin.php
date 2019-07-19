<?php

use app\models\Category;
use app\models\Pages;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use app\assets\ltAppAsset;

AppAsset::register($this);
ltAppAsset::register($this);

if (empty($_SESSION['city'])) {
    $_SESSION['city'] = "Москва";
}

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; <?=Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?=Html::csrfMetaTags(); ?>
    <title>Админка NOROF</title>
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
        <a href="<?=Url::to(['/admin/advert']);?>" class="btn menu-btn">Объявления</a>
        <?php if (Yii::$app->user->identity->oldAttributes['role'] == 'admin'):?>
            <a href="<?=Url::to(['/admin/category']);?>" class="btn menu-btn">Категории</a>
            <a href="<?=Url::to(['/admin/city']);?>" class="btn menu-btn">Города</a>
            <a href="<?=Url::to(['/admin/moderate']);?>" class="btn menu-btn">Модераторы</a>
            <a href="<?=Url::to(['/admin/users']);?>" class="btn menu-btn">Пользователи</a>
            <a href="<?=Url::to(['/admin/advertising']);?>" class="btn menu-btn">Реклама</a>
            <a href="<?=Url::to(['/admin/pages']);?>" class="btn menu-btn">Правовые документы</a>
        <?php endif; ?>
        <a href="<?=Url::to(['/site/logout']); ?>" class="btn menu-btn exit">Выход</a>
    </div>
</header>
<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 lk_info">
                <p class="info_mail">Личная инфомация</p>
                <a href="<?= Url::to(['users/edit-profile', 'id' => Yii::$app->user->identity->oldAttributes['id']]); ?>" class="btn create_moder">Изменить профиль</a>
            </div>
            <?php if (Yii::$app->user->identity->oldAttributes['role'] == 'admin'):?>
                <div class="col-lg-4 insctr">
                    <p class="info_mail">Инструменты</p>
                    <div class="clear">
                        <?=Html::button('Очистить кеш', ['class' => 'btn btn-info clear_cach']) ?>
                        <div class="alert alert-success clear_al_s" role="alert"></div>
                        <div class="alert alert-danger clear_al_d" role="alert"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
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
                <li><a href="<?=Url::to(['/pages/view', 'name' => $page['transliter']]); ?>"><?php echo $page['title']; ?></a></li>
            <?php endforeach;?>
        </ul>
        <ul class="list-unstyled menu_footer">
            <li><a href="<?=Url::home(); ?>">Главная</a></li>

            <?php $cache_category = Yii::$app->cache->get('cache_category');
            if ($cache_category) {
                $categorys = $cache_category;
            } else {
                $categorys = Category::find()->where(['not in', 'id', 0])->andWhere(['parent_id' => 0])->orderBy('name')->asArray()->all();
                // Записываем в кэш
                Yii::$app->cache->set('cache_category', $categorys, 60);
            } ?>
            <?php $cat = array_chunk($categorys, count($categorys)/2); ?>

            <?php foreach ($cat[0] as $category): ?>
                <?php if ($category['transliter'] != "Glavnaya_stranica" || $category['name'] != "Главная страница"): ?>
                <li><a href="<?=Url::to(['/category/view', 'name' => $category['transliter']]);?>"><?php echo $category['name'];?></a></li>
                <?php endif; ?>
            <?php endforeach;?>
        </ul>
        <ul class="list-unstyled menu_footer">
            <?php foreach ($cat[1] as $category): ?>
                <?php if ($category['transliter'] != "Glavnaya_stranica" || $category['name'] != "Главная страница"): ?>
                    <li><a href="<?=Url::to(['/category/view', 'name' => $category['transliter']]);?>"><?php echo $category['name'];?></a></li>
                <?php endif; ?>
            <?php endforeach;?>
        </ul>
        <a href="<?=Url::to(['/kabinet/index']);?>" class="add_footer">Разместить объявление</a>
        <a href="<?=Url::home(); ?>" class="logo_footer">
            <?=Html::img('@web/images/logo-white.svg', ['alt' => 'Лого футер']); ?>
        </a>
    </div>
</footer>

<script type="text/javascript">
    $(document).ready(function () {
        $(".clear_cach").on("click", function (e) {
            e.preventDefault();
            var isTrue = confirm("Желаете очистить кеш?");
            if (isTrue == true) {
                $.ajax({
                    type: 'POST',
                    cache: false,
                    url: 'users/clear-cache',
                    success: function(data) {
                        console.log(data);
                        if(data) {
                            $(".clear_al_d").css({"display":"none"});
                            $(".clear_al_s").html("Кеш успешно очищен");
                            $(".clear_al_s").css({"display":"block"});
                        } else {
                            $(".clear_al_s").css({"display":"none"});
                            $(".clear_al_d").html("Произошла непредвиденная ошибка");
                            $(".clear_al_d").css({"display":"block"});
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText + '|\n' + status + '|\n' +error);
                    }
                });
            }
        });
    });
</script>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>