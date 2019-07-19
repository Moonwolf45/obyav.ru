<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 10.11.2017
 * Time: 1:52
 */

namespace app\controllers;


use Yii;
use app\models\Category;
use app\models\Advert;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AllController {

    public function actionIndex() {
        $cat_o = Category::find()->where(['id' => 1])->one();

        $adverts_all = Advert::find()->with('user')->where(['type' => 'active', 'adv_active' => 'active'])->orderBy(['id' => SORT_DESC]);
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $adverts_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $adverts = $adverts_all->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('NOROF', $cat_o->keywords, $cat_o->description);

        return $this->render('index', compact('categorys', 'adverts', 'pages'));
    }

    public function actionView($name) {
        $category = Category::findOne(['transliter' => $name]);
        if (empty($category)) {
            throw new HttpException(404, 'Такой категории не существует.');
        }

        $cat_name = $category->name;
        $categorys = Category::find()->andWhere(['parent_id' => $category->id])->orderBy('name')->all();

        $adverts_category_all = Advert::find()->with('user')->where(['category_id' => $category->id, 'type' => 'active', 'adv_active' => 'active'])->orderBy(['advert.id' => SORT_DESC]);
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $adverts_category_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $adverts_category = $adverts_category_all->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('NOROF | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('cat_name', 'adverts_category', 'pages', 'categorys'));
    }

    public function actionSearch() {
        $q = trim(Yii::$app->request->get('q'));
        $cat = Yii::$app->request->get('cat');

        if (empty($q)) return $this->render('search');

        if (empty($cat)) {
            $search_adverts_all = Advert::find()->with('user')->where(['adv_active' => 'active'])->andWhere(['like', 'name', $q]);
        } else {
            $search_adverts_all = Advert::find()->with('user')->where(['category_id' => $cat, 'adv_active' => 'active'])->andWhere(['like', 'name', $q]);
        }
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $search_adverts_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $search_adverts = $search_adverts_all->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('NOROF | Поиск: ' . $q);

        return $this->render('search', compact('search_adverts', 'pages', 'q'));
    }
}