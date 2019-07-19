<?php

use yii\helpers\Html;

?>

<div class="row">
    <div class="category_obyav">
        <div class="col-lg-5 kartinka">
            <?php if(!empty($advert['gallery'])): ?>
                <div class="slider-for">
                    <div>
                        <?=Html::img('@web/images/advert/'.$advert['images'], ['alt' => $advert['name']]);?>
                    </div>
                    <?php foreach ($advert['gallery'] as $gallery): ?>
                        <div>
                            <?=Html::img('@web/images/advert/'.$gallery['images'], ['alt' => $advert['name']]);?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="slider-nav">
                    <div>
                        <?=Html::img('@web/images/advert/'.$advert['images'], ['alt' => $advert['name']]);?>
                    </div>
                    <?php foreach ($advert['gallery'] as $gallery): ?>
                        <div>
                            <?=Html::img('@web/images/advert/'.$gallery['images'], ['alt' => $advert['name']]);?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <?=Html::img('@web/images/advert/'.$advert['images'], ['alt' => $advert['name']]);?>
            <?php endif;?>
        </div>
        <div class="col-lg-7">
            <p class="obyav_name"><?php echo $advert['name']; ?></p>
            <p class="detail-info"><?php echo $advert['description']; ?></p>
            <ul class="list-unstyled list-inline">
                <li class="city-us"><?php echo $advert['city']; ?></li>
                <li class="name-us"><?php echo $advert['user']['name']; ?></li>
                <li class="email-us"><a href="email:<?php echo $advert['user']['email']; ?>"><?php echo $advert['user']['email']; ?></a></li>
                <li class="tel-us"><a href="tel:<?php echo $advert['user']['tel']; ?>"><?php echo $advert['user']['tel']; ?></a></li>
                <li class="sum-us"><?php echo number_format($advert['price'], 2, '.', ' '); ?> руб.</li>
                <?php if ($advert['type'] == "active"): ?>
                    <li class="status-us"><p class="text-success">Активное</p></li>
                <?php elseif ($advert['type'] == "blocked"): ?>
                    <li class="status-us"><p class="text-danger">Заблокировано</p></li>
                <?php elseif ($advert['type'] == "moderate"): ?>
                    <li class="status-us"><p class="text-info">На модерации</p></li>
                <?php endif; ?>
                <?php if ($advert['adv_active'] == "active"): ?>
                    <li class="status-us"><p class="text-success">Включено</p></li>
                <?php else: ?>
                    <li class="status-us"><p class="text-danger">Выключено</p></li>
                <?php endif; ?>
            </ul>
        </div>
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