<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_145933_category extends Migration {
    public function safeUp() {
        $this->createTable('category', [
            'id'          => Schema::TYPE_PK,
            'parent_id'   => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'name'        => Schema::TYPE_STRING . ' NOT NULL',
            'keywords'    => Schema::TYPE_STRING,
            'description' => Schema::TYPE_STRING
        ]);
    }

    public function safeDown() {
        echo "m171109_145933_category не может быть возвращено.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171109_145933_category cannot be reverted.\n";
        return false;
    }
    */
}
