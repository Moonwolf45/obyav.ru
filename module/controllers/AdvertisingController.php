<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 14.11.2017
 * Time: 21:33
 */

namespace app\module\controllers;


use app\models\Banner;
use Yii;
use yii\data\Pagination;
use yii\web\UploadedFile;

class AdvertisingController extends AllAdminController {

    public function actionIndex() {
        $banner_all = Banner::find()->with('category')->orderBy(['id' => SORT_DESC]);
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $banner_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $banners = $banner_all->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('banners', 'pages'));
    }

    public function actionCreate() {
        $model = new Banner;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            debug($model);
//            $model->name = $_POST['Banner']['name'];
//            $model->category_id = $_POST['Banner']['category_id'];
//            $model->periodicity = $_POST['Banner']['periodicity'];
//            $model->term = $_POST['Banner']['term'];
//            $model->date_create = date("Y-m-d");
//            $model->date_end = date('Y-m-d', strtotime("+".$_POST['Banner']['term']." days"));

//            if ($model->save()) {
//                $model->image = UploadedFile::getInstance($model, 'image');
//                if (!empty($model->image)) {
//                    if ($model->image->error == 0) {
//                        $model->upload();
//                    }
//                    unset($model->image);
//                }
//
////                return $this->redirect(array('/admin/advertising/index'));
//            }
        }

        return $this->render('create', compact('model'));
    }

    public function actionEdit($id) {
        $model = Banner::find()->where(['id' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->name = $_POST['Banner']['name'];
            $model->category_id = $_POST['Banner']['category_id'];
            $model->periodicity = $_POST['Banner']['periodicity'];
            $model->term = $_POST['Banner']['term'];
            $model->date_create = $_POST['Banner']['date_create'];
            $model->date_end = date('Y-m-d', strtotime("+".$_POST['Banner']['term']." days"));
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

                return $this->redirect(array('/admin/advertising/index'));
            }
        }

        return $this->render('edit', compact('model'));
    }

    public function actionDel($id) {
        $banner = Banner::find()->where(['id' => $id])->one();
        $banner->removeImage();
        $banner->delete();

        return $this->redirect(array('/admin/advertising/index'));
    }

}