<?php
/**
 * Created by PhpStorm.
 * User: Admin Neadekvat
 * Date: 16.11.2017
 * Time: 20:52
 */

namespace app\models;


use yii\db\ActiveRecord;

class Pages extends ActiveRecord {

    public static function tableName() {
        return 'pages';
    }

}