<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 14.11.2017
 * Time: 21:33
 */

namespace app\module\controllers;


use app\models\Advert;
use app\models\User;
use Yii;
use yii\data\Pagination;

class UsersController extends AllAdminController {

    public function actionIndex() {
        $user_all = User::find()->where(['not in', 'id', 1])->asArray();
        // подключаем класс Pagination, выводим по 8 пунктов на страницу
        $pages = new Pagination(['totalCount' => $user_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
        // приводим параметры в ссылке к ЧПУ
        $users = $user_all->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('users', 'pages'));
    }

    public function actionUnblock($id) {
        $user = User::find()->where(['id' => $id])->one();
        $user->type = 'active';
        $user->save();

        return $this->redirect(array('/admin/users'));
    }

    public function actionBlock($id) {
        $user = User::find()->where(['id' => $id])->one();
        $user->type = 'blocked';
        $user->save();

        return $this->redirect(array('/admin/users'));
    }

    public function actionDel($id) {
        $user = User::find()->where(['id' => $id])->one();
        $adverts = Advert::find()->where(['user_id' => $id])->all();
        foreach ($adverts as $adv) {
            $adv->removeImages();
        }
        $user->delete();

        return $this->redirect(array('/admin/users'));
    }

    public function actionEditProfile($id) {
        $user = User::find()->where(['id' => $id])->one();
        if ($user->load(Yii::$app->request->post()) && $user->validate()) {
            $user->name = $_POST['User']['name'];
            $user->email = $_POST['User']['email'];
            $user->tel = $_POST['User']['tel'];
            if ($_POST['User']['old_pass'] != "" || $_POST['User']['new_pass'] != "" || $_POST['User']['conf_new_pass'] != "") {
                $new_pass = $_POST['User']['new_pass'];
                $conf_new_pass = $_POST['User']['conf_new_pass'];
                if (Yii::$app->security->validatePassword($_POST['User']['old_pass'], $user->password)) {
                    if ($new_pass == $conf_new_pass) {
                        $user->password = Yii::$app->security->generatePasswordHash($_POST['User']['new_pass']);
                        if ($user->save()) {
                            return $this->redirect(array('/admin/users'));
                        }
                    } else {
                        $error_pass = "";
                        $error_pass = "Новые пароли не совпадают";
                        return $this->render('edit-profile', compact('user', 'error_pass'));
                    }
                } else {
                    $error_pass = "";
                    $error_pass = "Текущий пароль введен не верно";
                    return $this->render('edit-profile', compact('user', 'error_pass'));
                }
            } else {
                if ($user->save()) {
                    return $this->redirect(array('/admin/users'));
                }
            }
        }

        return $this->render('edit-profile', compact('user'));
    }

    public function actionFilter() {
        $users = Yii::$app->request->get('email');

        if (!empty($users)) {
            $user_all = User::find()->where(['not in', 'id', 1])->andWhere(['or',['like', 'name', $users],['like', 'email', $users]])->asArray();
            // подключаем класс Pagination, выводим по 8 пунктов на страницу
            $pages = new Pagination(['totalCount' => $user_all->count(), 'pageSize' => 5, 'forcePageParam' => false, 'pageSizeParam' => false]);
            // приводим параметры в ссылке к ЧПУ
            $users = $user_all->offset($pages->offset)->limit($pages->limit)->all();
        }

        return $this->render('index', compact('users', 'pages'));
    }

    public function actionClearCache() {
        if(Yii::$app->cache->flush()) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

}