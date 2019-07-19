<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $images
 * @property string $name
 * @property string $translit
 * @property string $keywords
 * @property string $description
 */
class Category extends ActiveRecord {

    public $image;

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category';
    }

    public function getAdvert() {
        return $this->hasMany(Advert::className(), ['category_id' => 'id']);
    }

    public function getBanners() {
        return $this->hasMany(Banner::className(), ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_id'], 'integer'],
            [['name', 'transliter'], 'required'],
            [['name', 'transliter', 'keywords', 'description'], 'string', 'max' => 255],

            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Название',
            'transliter' => 'Translit',
            'keywords'  => 'SEO-Ключевики',
            'description' => 'SEO-Описание',

            'image' => 'Картинка',
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'images/category/original/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }
}
