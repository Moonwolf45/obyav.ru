<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 14.11.2017
 * Time: 21:32
 */

namespace app\module\controllers;


use app\models\Advert;
use app\models\User;
use app\module\models\RegisterModerate;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;

class ModerateController extends AllAdminController {

    public function actionIndex() {
        $user_all = User::find()->where(['role' => 'moderated'])->asArray();
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $user_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $user = $user_all->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('user', 'pages'));
    }

    public function actionViewAdverts($id) {
        $adverts_user = Advert::find()->with('user')->where(['user_id' => $id])->orderBy(['id' => SORT_DESC])->asArray();
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $adverts_user->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $adverts_all = $adverts_user->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('view-adverts', compact('adverts_all', 'pages'));
    }

    public function actionAdverts($id) {
        $advert = Advert::find()->with('category')->with('user')->with('gallery')->where(['id' => $id])->limit(1)->asArray()->one();

        if (empty($advert)) {
            throw new HttpException(404, 'Такого объявления не существует.');
        }

        return $this->render('adverts', compact('advert'));
    }

    public function actionCreate() {
        $model = new RegisterModerate();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->name = $model->name;
            $user->tel = $model->tel;
            $user->email = $model->email;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->role = 'moderated';
            $user->type = 'active';
            if ($user->save()) {
                return $this->redirect(array('/admin/moderate'));
            }
        }

        return $this->render('create_mod', compact('model'));
    }

    public function actionUnblock($id) {
        $user = User::find()->where(['id' => $id])->one();
        $user->type = 'active';
        $user->save();

        return $this->redirect(array('/admin/moderate'));
    }

    public function actionBlock($id) {
        $user = User::find()->where(['id' => $id])->one();
        $user->type = 'blocked';
        $user->save();

        return $this->redirect(array('/admin/moderate'));
    }

    public function actionDel($id) {
        $user = User::find()->where(['id' => $id])->one();
        $user->role = 'user';
        $user->save();

        return $this->redirect(array('/admin/moderate'));
    }

    public function actionFilter() {
        $users = Yii::$app->request->get('email');

        if (!empty($users)) {
            $user_all = User::find()->where(['not in', 'id', 1])->andWhere(['or',['like', 'name', $users],['like', 'email', $users]])->asArray();
            // подключаем класс Pagination, выводим по 8 пунктов на страницу
            $pages = new Pagination(['totalCount' => $user_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
            // приводим параметры в ссылке к ЧПУ
            $user = $user_all->offset($pages->offset)->limit($pages->limit)->all();
        }

        return $this->render('index', compact('user', 'pages'));
    }

}