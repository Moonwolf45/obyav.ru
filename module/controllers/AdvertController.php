<?php

namespace app\module\controllers;


use app\models\Advert;
use app\models\City;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;

class AdvertController extends AllAdminController {

    public function actionIndex() {
        $adverts_all = Advert::find()->with('user')->where(['city' => $_SESSION['city'], 'type' => 'moderate', 'adv_active' => 'active'])->orderBy(['id' => SORT_DESC]);
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $adverts_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $adverts_category = $adverts_all->offset($pages->offset)->limit($pages->limit)->all();

        $city = City::find()->all();

        return $this->render('index', compact('adverts_category', 'pages', 'city'));
    }

    public function actionView($id) {
        $advert = Advert::find()->with('category')->with('user')->where(['id' => $id, 'adv_active' => 'active'])->limit(1)->one();
        if (empty($advert)) {
            throw new HttpException(404, 'Такого объявления не существует.');
        }

        return $this->render('view', compact('advert'));
    }

    public function actionActive($id) {
        $advert = Advert::find()->where(['id' => $id])->limit(1)->one();
        $advert->type = 'active';
        $advert->save();

        return $this->redirect(array('/admin/advert'));
    }

    public function actionBlocked($id) {
        $advert = Advert::find()->where(['id' => $id])->limit(1)->one();
        $advert->type = 'blocked';
        $advert->save();

        return $this->redirect(array('/admin/advert'));
    }

    public function actionFilter() {
        $city_f = Yii::$app->request->get('city');

        if (!empty($city_f)) {
            $_SESSION['city'] = $city_f;
            $adverts_all = Advert::find()->with('user')->where(['city' => $_SESSION['city'], 'type' => 'moderate', 'adv_active' => 'active'])->orderBy(['id' => SORT_DESC]);
            // подключаем класс Pagination, выводим по 8 пунктов на страницу
            $pages = new Pagination(['totalCount' => $adverts_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
            // приводим параметры в ссылке к ЧПУ
            $adverts_category = $adverts_all->offset($pages->offset)->limit($pages->limit)->all();
        } else {
            $adverts_all = Advert::find()->with('user')->where(['type' => 'moderate', 'adv_active' => 'active'])->orderBy(['id' => SORT_DESC]);
            // подключаем класс Pagination, выводим по 8 пунктов на страницу
            $pages = new Pagination(['totalCount' => $adverts_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
            // приводим параметры в ссылке к ЧПУ
            $adverts_category = $adverts_all->offset($pages->offset)->limit($pages->limit)->all();
        }
        $city = City::find()->all();
        return $this->render('index', compact('adverts_category', 'pages', 'city'));
    }

}
