<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 14.11.2017
 * Time: 21:33
 */

namespace app\module\controllers;


use app\models\Pages;
use app\module\models\InfoPage;
use Yii;
use yii\data\Pagination;
use dastanaron\translit\Translit;

class PagesController extends AllAdminController {

    public function actionIndex() {
        $pages_all = Pages::find()->asArray();
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $pages_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $all_page = $pages_all->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('all_page', 'pages'));
    }

    public function actionCreate() {
        $model = new InfoPage();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $new_page = new Pages();
            $transliteration = new Translit();
            $new_page->title = $model->title;
            $new_page->transliter = $transliteration->translit($model->title, true);
            $new_page->meta_keywords = $model->meta_keywords;
            $new_page->meta_description = $model->meta_description;
            $new_page->description = $model->description;
            if ($new_page->save()) {
                return $this->redirect(array('/admin/pages'));
            }
        }

        return $this->render('create', compact('model'));
    }

    public function actionEdit($id) {
        $model = Pages::find()->where(['id' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transliteration = new Translit();
            $model->title = $_POST['Pages']['title'];
            $model->transliter = $transliteration->translit($_POST['Pages']['title'], true);
            $model->meta_keywords = $_POST['Pages']['meta_keywords'];
            $model->meta_description = $_POST['Pages']['meta_description'];
            $model->description = $_POST['Pages']['description'];
            if ($model->save()) {
                return $this->redirect(array('/admin/pages'));
            }
        }

        return $this->render('edit', compact('model'));
    }

    public function actionDel($id) {
        $page_one = Pages::find()->where(['id' => $id])->one();
        $page_one->delete();

        return $this->redirect(array('/admin/pages'));
    }

}