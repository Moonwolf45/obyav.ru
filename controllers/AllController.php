<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 10.11.2017
 * Time: 1:53
 */

namespace app\controllers;


use yii\web\Controller;

class AllController extends Controller {

    protected function setMeta($title = null, $keywords = null, $description = null) {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

}