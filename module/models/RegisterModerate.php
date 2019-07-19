<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 16.11.2017
 * Time: 16:08
 */

namespace app\module\models;


use app\models\User;
use yii\base\Model;

class RegisterModerate extends Model {

    public $name;
    public $email;
    public $tel;
    public $password;
    public $confirmPassword;

    public function rules() {
        return [
            [['name', 'email', 'password', 'confirmPassword'], 'required', 'message' => 'Заполните поле'],
            [['name', 'email'], 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(),  'message' => 'Этот e-mail уже занят'],
            ['tel', 'string'],
            ['password', 'compare', 'compareAttribute' => 'confirmPassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'name'            => 'Имя',
            'email'           => 'E-mail',
            'tel'             => 'Телефон',
            'password'        => 'Пароль',
            'confirmPassword' => 'Повторите пароль',
        ];
    }

}

?>