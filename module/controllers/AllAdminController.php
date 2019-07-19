<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 12.11.2017
 * Time: 19:25
 */

namespace app\module\controllers;


use yii\web\Controller;

class AllAdminController extends Controller {

    protected function setMeta($title = 'Админка NOROF') {
        $this->view->title = $title;
    }

}