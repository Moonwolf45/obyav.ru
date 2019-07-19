<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 16.11.2017
 * Time: 21:44
 */

namespace app\module\models;


use app\models\Pages;
use yii\base\Model;

class InfoPage extends Model {

    public static function tableName() {
        return 'pages';
    }

    public $title;
    public $meta_keywords;
    public $meta_description;
    public $transliter;
    public $description;

    public function rules() {
        return [
            [['title', 'description'], 'required', 'message' => 'Заполните поле'],
            [['title', 'description', 'meta_keywords', 'meta_description'], 'trim'],
            ['transliter', 'unique', 'targetClass' => Pages::className(),  'message' => 'Этот "Адрес" уже занят'],
            [['title', 'description', 'transliter', 'meta_keywords', 'meta_description'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'title'            => 'Название страницы',
            'meta_keywords'    => 'SEO-Ключевики',
            'meta_description' => 'SEO-Описание',
            'transliter'       => 'SEO-Адрес',
            'description'      => 'Контент',
        ];
    }

}

?>