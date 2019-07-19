<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 10.11.2017
 * Time: 16:45
 */

namespace app\controllers;


use app\models\Advert;
use yii\web\HttpException;

class AdvertController extends AllController {

    public function actionView($id) {
        $advert = Advert::find()->with('category')->with('user')->where(['id' => $id, 'adv_active' => 'active'])->limit(1)->one();
        if (empty($advert)) {
            throw new HttpException(404, 'Такого объявления не существует.');
        }

        $random_advert = Advert::find()->where(['not in', 'id', $advert['id']])->andWhere(['category_id' => $advert['category_id'], 'type' => 'active', 'adv_active' => 'active'])->limit(5)->all();

        $this->setMeta('NOROF | ' . $advert['name']);

        return $this->render('view', compact('advert', 'random_advert'));
    }

}