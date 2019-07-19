<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 18.11.2017
 * Time: 13:39
 */

namespace app\models;


use yii\base\Model;

class RegisterUser extends Model {

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