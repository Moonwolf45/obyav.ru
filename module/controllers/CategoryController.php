<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 20.11.2017
 * Time: 15:27
 */

namespace app\module\controllers;


use app\models\Category;
use dastanaron\translit\Translit;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;

class CategoryController extends AllAdminController {

    public function actionIndex() {
        $category_all = Category::find();
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $category_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $all_category = $category_all->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('all_category', 'pages'));
    }

    public function actionCreate() {
        $model = new Category();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transliteration = new Translit();
            $model->parent_id = $_POST['Category']['parent_id'];
            $model->name = $_POST['Category']['name'];
            $model->transliter = $transliteration->translit($_POST['Category']['name'], true);
            $model->keywords = $_POST['Category']['keywords'];
            $model->description = $_POST['Category']['description'];
            if ($model->save()) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if (!empty($model->image)) {
                    if ($model->image->error == 0) {
                        $model->upload();
                    }
                    unset($model->image);
                }

                return $this->redirect(array('/admin/category/index'));
            }
        }

        return $this->render('create', compact('model'));
    }

    public function actionEdit($id) {
        $model = Category::find()->where(['id' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transliteration = new Translit();
            if ($_POST['Category']['parent_id'] == '' || $_POST['Category']['parent_id'] == NULL) {
                $model->parent_id = 0;
            } else {
                $model->parent_id = $_POST['Category']['parent_id'];
            }
            $model->name = $_POST['Category']['name'];
            $model->transliter = $transliteration->translit($_POST['Category']['name'], true);
            $model->keywords = $_POST['Category']['keywords'];
            $model->description = $_POST['Category']['description'];
            if ($model->save()) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if (!empty($model->image)) {
                    $old = $model->getImage();
                    $model->removeImage($old);
                    if ($model->image->error == 0) {
                        $model->upload();
                    }
                    unset($model->image);
                }

                return $this->redirect(array('/admin/category/index'));
            }
        }

        return $this->render('edit', compact('model'));
    }

    public function actionDel($id) {
        $category_one = Category::find()->where(['id' => $id])->one();
        $category_one->removeImage();
        $category_one->delete();

        return $this->redirect(array('/admin/category/index'));
    }

}