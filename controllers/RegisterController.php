<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 18.11.2017
 * Time: 13:45
 */

namespace app\controllers;


use app\models\RegisterUser;
use app\models\User;

class RegisterController extends AllController {

    public function actionNew() {
        $model = new RegisterUser();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->name = $model->name;
            $user->tel = $model->tel;
            $user->email = $model->email;
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $user->role = 'user';
            $user->type = 'active';
            if ($user->save()) {
                return $this->redirect(array('/site/login'));
            }
        }

        $this->setMeta('NOROF | Регистрация');

        return $this->render('new', compact('model'));
    }

}