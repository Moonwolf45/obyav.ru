<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 18.11.2017
 * Time: 12:35
 */

namespace app\controllers;


use app\models\Pages;
use yii\web\HttpException;

class PagesController extends AllController {

    public function actionView($name) {
        $page_con = Pages::find()->where(['transliter' => $name])->asArray()->one();
        if (empty($page_con)) {
            throw new HttpException(404, 'Такой страницы не существует.');
        }

        $this->setMeta('NOROF | ' . $page_con['title'], $page_con['meta_keywords'], $page_con['meta_description']);

        return $this->render('view', compact('page_con'));
    }

}