<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 10.11.2017
 * Time: 0:38
 */

namespace app\models;


use yii\db\ActiveRecord;

class Advert extends ActiveRecord {

    public $image;
    public $gallery;

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public static function tableName() {
        return 'advert';
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id', 'user_id', 'name', 'city', 'price'], 'required', 'message' => 'Заполните поле'],
            [['category_id', 'user_id'], 'integer'],
            [['name', 'description'], 'trim'],
            [['price'], 'double'],
            [['type', 'adv_active'], 'string'],
            [['name', 'description', 'city'], 'string', 'max' => 255],

            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'user_id' => 'User ID',

            'image'       => 'Картинка',
            'gallery'     => 'Доп. картинки',

            'name' => 'Название',
            'description' => 'Контент',
            'city' => 'Город',
            'price' => 'Цена',
            'type' => 'Статус проверки',
            'adv_active' => 'Статус оъявления',
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'images/advert/original/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }

    public function uploadGallery() {
        if ($this->validate()) {
            foreach ($this->gallery as $img_one) {
                $path = 'images/advert/original/' . $img_one->baseName . '.' . $img_one->extension;
                $img_one->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        } else {
            return false;
        }
    }
}