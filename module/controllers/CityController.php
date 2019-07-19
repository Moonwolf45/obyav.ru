<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 20.11.2017
 * Time: 15:28
 */

namespace app\module\controllers;


use app\models\City;
use Yii;
use yii\data\Pagination;

class CityController extends AllAdminController {

    public function actionIndex() {
        $city_all = City::find();
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $city_all->count(), 'pageSize' => 10, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $all_city = $city_all->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('all_city', 'pages'));
    }

    public function actionCreate() {
        $model = new City();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->name = $_POST['City']['name'];
            if ($model->save()) {
                return $this->redirect(array('/admin/city/index'));
            }
        }

        return $this->render('create', compact('model'));
    }

    public function actionEdit($id) {
        $model = City::find()->where(['id' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->name = $_POST['City']['name'];
            if ($model->save()) {
                return $this->redirect(array('/admin/city/index'));
            }
        }

        return $this->render('edit', compact('model'));
    }

    public function actionDel($id) {
        $category_one = City::find()->where(['id' => $id])->one();
        $category_one->delete();

        return $this->redirect(array('/admin/city/index'));
    }

}