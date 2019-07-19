<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_145740_advert extends Migration {
    public function safeUp() {
        $this->createTable('advert', [
            'id'           => Schema::TYPE_PK,
            'category_id'  => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'user_id'      => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'name'         => Schema::TYPE_STRING,
            'description'  => Schema::TYPE_STRING,
            'price'        => Schema::TYPE_MONEY,
            'type'         => 'ENUM("active", "blocked", "moderate") NOT NULL DEFAULT "moderate"'
        ]);
    }

    public function safeDown() {
        echo "m171109_145740_advert не может быть возвращено.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171109_145740_advert cannot be reverted.\n";
        return false;
    }
    */
}
