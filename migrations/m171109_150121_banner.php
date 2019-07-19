<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_150121_banner extends Migration {
    public function safeUp() {
        $this->createTable('banner', [
            'id'           => Schema::TYPE_PK,
            'category_id'  => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'periodicity'  => 'ENUM("3", "5") NOT NULL DEFAULT "3"',
            'term'         => Schema::TYPE_INTEGER
        ]);
    }

    public function safeDown() {
        echo "m171109_150121_banner не может быть возвращено.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171109_150121_banner cannot be reverted.\n";
        return false;
    }
    */
}
