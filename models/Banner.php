<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $periodicity
 * @property string $freak
 * @property integer $term
 * @property string $date_create
 * @property string $date_end
 */
class Banner extends ActiveRecord {

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
        return 'banner';
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id', 'date_create', 'date_end', 'name'], 'required'],
            [['category_id', 'term'], 'integer'],
            [['periodicity', 'name'], 'string'],
            [['date_create', 'date_end'], 'safe'],

            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Название баннера',
            'category_id' => '№ Категории',
            'periodicity' => 'Переодичность',
            'term' => 'Срок размещения',
            'date_create' => 'Дата создания',
            'date_end' => 'Дата окончания',
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'images/banner/original/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }
}
