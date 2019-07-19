<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 site-error">
        <h1><?=Html::encode($this->title);?></h1>
        <?=Html::img('@web/images/404.jpg', ['class' => 'error_404', 'alt' => '404']);?>
        <p>Вы смотриту на это страницу уже 20 секунд.<br>
            Странно, что Вы еще тут.<br>
            Похоже, что вы настойчевый человек.<br>
            Однако это не та страница, которая Вам нужна.<br>
            Чесно не та.<br>
            Страницы, которую Вы запрашиваете, не существует.<br>
            Ну, ладно...<br>
            Сейчас попробую её поискать..._</p>
        <div class="alert alert-danger">
            <?=nl2br(Html::encode($message));?>
        </div>
    </div>
</div>
