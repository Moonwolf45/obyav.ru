<?php

use yii\helpers\Html;

?>

<div class="row">
    <div class="category_obyav">
        <h3>Объявления</h3>
        <div class="col-lg-5 kartinka">
            <?php $get_gallery = $advert->getImages(); ?>
            <?php if(count($get_gallery) > 1): ?>
                <div class="slider-for">
                    <?php foreach ($get_gallery as $img): ?>
                        <div>
                            <?=Html::img($img->getUrl(), ['alt' => $advert['name']]);?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="slider-nav">
                    <?php foreach ($get_gallery as $img): ?>
                        <div>
                            <?=Html::img($img->getUrl(), ['alt' => $advert['name']]);?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <?=Html::img($get_gallery[0]->getUrl(), ['alt' => $advert['name']]);?>
            <?php endif;?>
        </div>
        <div class="col-lg-7">
            <p class="obyav_name"><?php echo $advert['name']; ?></p>
            <p class="detail-info"><?php echo $advert['description']; ?></p>
            <ul class="list-unstyled list-inline">
                <li class="city-us"><small class="info_stroka">Город: </small><?php echo $advert['city']; ?></li>
                <li class="name-us"><small class="info_stroka">Имя: </small><?php echo $advert['user']['name']; ?></li>
                <li class="email-us"><small class="info_stroka">E-mail: </small><a href="email:<?php echo $advert['user']['email']; ?>"><?php echo $advert['user']['email']; ?></a></li>
                <li class="tel-us"><small class="info_stroka">Телефон: </small><a href="tel:<?php echo $advert['user']['tel']; ?>"><?php echo $advert['user']['tel']; ?></a></li>
                <li class="sum-us"><small class="info_stroka">Цена: </small><?php echo number_format($advert['price'], 2, '.', ' '); ?> руб.</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="buttons_type">
        <?= Html::a('Принять', ['advert/active', 'id' => $advert['id']], ['class' => 'btn btn_view_t_active']); ?>
        <?= Html::a('Отклонить', ['advert/blocked', 'id' => $advert['id']], ['class' => 'btn btn_view_t_blocked']); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<img class="slick-prev" src="/images/left_arrow.svg" alt="Left_arrow">',
            nextArrow: '<img class="slick-next" src="/images/right_arrow.svg" alt="Right_arrow">',
            fade: true,
            asNavFor: '.slider-nav',
            infinite: false
        });

        $('.slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            arrows: false,
            dots: false,
            centerMode: true,
            centerPadding: '40px',
            infinite: false
        });
    });
</script>