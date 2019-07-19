<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_145949_user extends Migration {
    public function safeUp() {
        $this->createTable('user', [
            'id'    => Schema::TYPE_PK,
            'name'  => Schema::TYPE_STRING . ' NOT NULL',
            'tel'   => Schema::TYPE_STRING. ' NOT NULL',
            'email' => Schema::TYPE_STRING. ' NOT NULL',
            'role'  => 'ENUM("admin", "moderated", "user") NOT NULL DEFAULT "user"',
            'type'  => 'ENUM("active", "blocked") NOT NULL DEFAULT "active"'
        ]);
    }

    public function safeDown() {
        echo "m171109_145949_user не может быть возвращено.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171109_145949_user cannot be reverted.\n";
        return false;
    }
    */
}
