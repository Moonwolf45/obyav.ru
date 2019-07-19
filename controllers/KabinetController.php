<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 17.11.2017
 * Time: 11:26
 */

namespace app\controllers;


use app\models\Advert;
use app\models\Category;
use app\models\City;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class KabinetController extends AllController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $user_id = Yii::$app->user->identity->oldAttributes['id'];

        $adverts_active = Advert::find()->where(['user_id' => $user_id, 'type' => 'active', 'adv_active' => 'active'])->orderBy(['id' => SORT_DESC])->all();
        $adverts_moder = Advert::find()->where(['user_id' => $user_id, 'type' => ['moderate', 'blocked'], 'adv_active' => 'active'])->orderBy(['id' => SORT_DESC])->all();
        $adverts_block = Advert::find()->where(['user_id' => $user_id, 'adv_active' => 'block'])->orderBy(['id' => SORT_DESC])->all();

        $this->setMeta('NOROF | Личный кабинет');

        return $this->render('index', compact('adverts_active', 'adverts_moder', 'adverts_block'));
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
                if (Yii::$app->security->validatePassword($_POST['User']['old_pass'], $user->password) && $new_pass != "" && $conf_new_pass != "") {
                    if ($new_pass == $conf_new_pass) {
                        $user->password = Yii::$app->security->generatePasswordHash($_POST['User']['new_pass']);
                        if ($user->save()) {
                            return $this->redirect(array('/kabinet/index'));
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
                    return $this->redirect(array('/kabinet/index'));
                }
            }
        }

        $this->setMeta('NOROF | Редактирование профиля');

        return $this->render('edit-profile', compact('user'));
    }

    public function actionCreate() {
        $model = new Advert();
        $category = Category::find()->all();
        $cities = City::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->category_id = $_POST['Advert']['category_id'];
            $model->user_id = $_POST['Advert']['user_id'];
            $model->name = $_POST['Advert']['name'];
            $model->description = $_POST['Advert']['description'];
            $model->city = $_POST['Advert']['city'];
            $model->price = $_POST['Advert']['price'];
            $model->type = $_POST['Advert']['type'];
            $model->adv_active = $_POST['Advert']['adv_active'];
            if ($model->save()) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image->error == 0) {
                    $model->upload();
                }
                unset($model->image);

                $model->gallery = UploadedFile::getInstances($model, 'gallery');
                $model->uploadGallery();

                return $this->redirect(array('/kabinet/index'));
            }
        }

        $this->setMeta('NOROF | Создание объявлений');

        return $this->render('create-ad', compact('model', 'category', 'cities'));
    }

    public function actionEdit($id) {
        $model = Advert::find()->where(['id' => $id])->one();
        $category = Category::find()->all();
        $cities = City::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->category_id = $_POST['Advert']['category_id'];
            $model->user_id = $_POST['Advert']['user_id'];
            $model->name = $_POST['Advert']['name'];
            $model->description = $_POST['Advert']['description'];
            $model->city = $_POST['Advert']['city'];
            $model->price = $_POST['Advert']['price'];
            $model->type = $_POST['Advert']['type'];
            $model->adv_active = $_POST['Advert']['adv_active'];
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

                if (!empty($model->gallery)) {
                    $model->gallery = UploadedFile::getInstances($model, 'gallery');
                    $model->uploadGallery();
                }

                return $this->redirect(array('/kabinet/index'));
            }
        }

        $this->setMeta('NOROF | Редактирование объявлений');

        return $this->render('edit-ad', compact('model', 'category', 'cities'));
    }

    public function actionDel($id) {
        $advert_one = Advert::find()->where(['id' => $id])->one();
        $advert_one->removeImages();
        $advert_one->delete();

        return $this->redirect(array('kabinet/index'));
    }

    public function actionDeleteImages($id_model, $image) {
        $advert = Advert::find()->where(['id' => $id_model])->one();

        $images = $advert->getImages();
        foreach($images as $img){
            if($img->id == $image){
                if ($advert->removeImage($img)) {
                    $res = true;
                } else {
                    $res = false;
                }
                return json_encode(['res' => $res]);
            }
        }
    }

}