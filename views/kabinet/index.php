<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-lg-12 lk_info">
        <p class="info_mail">Личная инфомация</p>
        <a href="<?=Url::to(['kabinet/edit-profile', 'id' => Yii::$app->user->identity->oldAttributes['id']]); ?>" class="btn create_moder">Изменить профиль</a>
    </div>
</div>
<div class="row">
    <div class="adverts">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active">
                <a href="#act_ad" data-toggle="tab">Активные</a>
            </li>
            <li role="presentation">
                <a href="#moder_ad" data-toggle="tab">На модерации</a>
            </li>
            <li role="presentation">
                <a href="#arh_ad" data-toggle="tab">В архиве</a>
            </li>
            <a href="<?= Url::to(['kabinet/create']); ?>" class="btn create_ad">Создать объявление</a>
        </ul>
        <div class="tab-content">
            <div id="act_ad" class="tab-pane fade in active">
                <?php if (!empty($adverts_active)): ?>
                    <?php foreach ($adverts_active as $advert_a): ?>
                        <div class="obyavlenie" id="<?=$advert_a['id']; ?>">
                            <div class="col-lg-3 kartinka">
                                <?php $img = $advert_a->getImage();?>
                                <?=Html::img($img->getUrl(), ['alt' => $advert_a['name']]);?>
                            </div>
                            <div class="col-lg-7">
                                <p class="obyav_name">
                                    <?php echo $advert_a['name'];?>
                                </p>
                                <div class="obyav-info">
                                    <?php if ($advert_a['description'] != "" || $advert_a['description'] != NULL): ?>
                                        <?php if (strlen($advert_a['description']) > 215) {
                                            $desc = trim(mb_substr($advert_a['description'], 0, 215));
                                            $desc .= "...";
                                            echo $desc;
                                        } else {
                                            echo $advert_a['description'];
                                        } ;?>
                                    <?php else: ?>
                                        <h3>Описание отсутствует</h3>
                                    <?php endif; ?>
                                </div>
                                <ul class="list-unstyled list-inline">
                                    <li class="list-kabinet"><small class="info_stroka">Город: </small><?php echo $advert_a['city'];?></li>
                                    <li class="list-kabinet"><small class="info_stroka">Цена: </small><?php echo number_format($advert_a['price'], 2, '.', ' ');?> руб.</li>
                                    <?php if ($advert_a['type'] == "active"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-success">Активное</p></li>
                                    <?php elseif ($advert_a['type'] == "blocked"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-danger">Заблокировано</p></li>
                                    <?php elseif ($advert_a['type'] == "moderate"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-info">На модерации</p></li>
                                    <?php endif; ?>
                                    <?php if ($advert_a['adv_active'] == "active"): ?>
                                        <li class="list-kabinet">Статус оъявления: <p class="text-success">Включено</p></li>
                                    <?php else: ?>
                                        <li class="list-kabinet">Статус оъявления: <p class="text-danger">Выключено</p></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="col-lg-2">
                                <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['kabinet/del', 'id' => $advert_a['id']]); ?>
                                <?=Html::a(Html::img('@web/images/pencil.svg', ['class' => 'img_block','alt' => 'Редактировать']), ['kabinet/edit', 'id' => $advert_a['id']]); ?>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else: ?>
                    <h2>У вас нет активных объявлений...</h2>
                <?php endif;?>
            </div>
            <div id="moder_ad" class="tab-pane fade">
                <?php if (!empty($adverts_moder)): ?>
                    <?php foreach ($adverts_moder as $advert_m): ?>
                        <div class="obyavlenie" id="<?=$advert_m['id']; ?>">
                            <div class="col-lg-3 kartinka">
                                <?php $img = $advert_m->getImage();?>
                                <?=Html::img($img->getUrl(), ['alt' => $advert_m['name']]);?>
                            </div>
                            <div class="col-lg-7">
                                <p class="obyav_name">
                                    <?php echo $advert_m['name'];?>
                                </p>
                                <div class="obyav-info">
                                    <?php if ($advert_m['description'] != "" || $advert_m['description'] != NULL): ?>
                                        <?php if (strlen($advert_m['description']) > 215) {
                                            $desc = trim(mb_substr($advert_m['description'], 0, 215));
                                            $desc .= "...";
                                            echo $desc;
                                        } else {
                                            echo $advert_m['description'];
                                        } ;?>
                                    <?php else: ?>
                                        <h3>Описание отсутствует</h3>
                                    <?php endif; ?>
                                </div>
                                <ul class="list-unstyled list-inline">
                                    <li class="list-kabinet"><small class="info_stroka">Город: </small><?php echo $advert_m['city'];?></li>
                                    <li class="list-kabinet"><small class="info_stroka">Цена: </small><?php echo number_format($advert_m['price'], 2, '.', ' ');?> руб.</li>
                                    <?php if ($advert_m['type'] == "active"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-success">Активное</p></li>
                                    <?php elseif ($advert_m['type'] == "blocked"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-danger">Заблокировано</p></li>
                                    <?php elseif ($advert_m['type'] == "moderate"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-info">На модерации</p></li>
                                    <?php endif; ?>
                                    <?php if ($advert_m['adv_active'] == "active"): ?>
                                        <li class="list-kabinet">Статус оъявления: <p class="text-success">Включено</p></li>
                                    <?php else: ?>
                                        <li class="list-kabinet">Статус оъявления: <p class="text-danger">Выключено</p></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="col-lg-2">
                                <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['kabinet/del', 'id' => $advert_m['id']]); ?>
                                <?=Html::a(Html::img('@web/images/pencil.svg', ['class' => 'img_block','alt' => 'Редактировать']), ['kabinet/edit', 'id' => $advert_m['id']]); ?>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else: ?>
                    <h2>У вас нет объявлений на модерации...</h2>
                <?php endif;?>
            </div>
            <div id="arh_ad" class="tab-pane fade">
                <?php if (!empty($adverts_block)): ?>
                    <?php foreach ($adverts_block as $advert_b): ?>
                        <div class="obyavlenie" id="<?=$advert_b['id']; ?>">
                            <div class="col-lg-3 kartinka">
                                <?php $img = $advert_b->getImage();?>
                                <?=Html::img($img->getUrl(), ['alt' => $advert_b['name']]);?>
                            </div>
                            <div class="col-lg-7">
                                <p class="obyav_name">
                                    <?php echo $advert_b['name'];?>
                                </p>
                                <div class="obyav-info">
                                    <?php if ($advert_b['description'] != "" || $advert_b['description'] != NULL): ?>
                                        <?php if (strlen($advert_b['description']) > 215) {
                                            $desc = trim(mb_substr($advert_b['description'], 0, 215));
                                            $desc .= "...";
                                            echo $desc;
                                        } else {
                                            echo $advert_b['description'];
                                        } ;?>
                                    <?php else: ?>
                                        <h3>Описание отсутствует</h3>
                                    <?php endif; ?>
                                </div>
                                <ul class="list-unstyled list-inline">
                                    <li class="list-kabinet"><small class="info_stroka">Город: </small><?php echo $advert_b['city'];?></li>
                                    <li class="list-kabinet"><small class="info_stroka">Цена: </small><?php echo number_format($advert_b['price'], 2, '.', ' ');?> руб.</li>
                                    <?php if ($advert_b['type'] == "active"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-success">Активное</p></li>
                                    <?php elseif ($advert_b['type'] == "blocked"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-danger">Заблокировано</p></li>
                                    <?php elseif ($advert_b['type'] == "moderate"): ?>
                                        <li class="list-kabinet">Статус проверки: <p class="text-info">На модерации</p></li>
                                    <?php endif; ?>
                                    <?php if ($advert_b['adv_active'] == "active"): ?>
                                        <li class="list-kabinet">Статус оъявления: <p class="text-success">Включено</p></li>
                                    <?php else: ?>
                                        <li class="list-kabinet">Статус оъявления: <p class="text-danger">Выключено</p></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="col-lg-2">
                                <?=Html::a(Html::img('@web/images/img_del.png', ['class' => 'img_del','alt' => 'Удалить']), ['kabinet/del', 'id' => $advert_b['id']]); ?>
                                <?=Html::a(Html::img('@web/images/pencil.svg', ['class' => 'img_block','alt' => 'Редактировать']), ['kabinet/edit', 'id' => $advert_b['id']]); ?>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else: ?>
                    <h2>У вас нет отключенных объявлений...</h2>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>