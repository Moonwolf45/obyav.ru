<?php

use yii\db\Migration;
use yii\db\Schema;

class m171116_154514_pages extends Migration {
    public function safeUp() {
        $this->createTable('pages', [
            'id'               => Schema::TYPE_PK,
            'meta_keywords'    => Schema::TYPE_STRING . ' DEFAULT NULL',
            'meta_description' => Schema::TYPE_STRING . ' DEFAULT NULL',
            'title'            => Schema::TYPE_STRING . ' NOT NULL',
            'translit'         => Schema::TYPE_STRING . ' NOT NULL',
            'description'      => Schema::TYPE_STRING . ' NOT NULL'
        ]);
    }

    public function safeDown() {
        echo "m171116_154514_pages не может быть возвращено.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171116_154514_pages cannot be reverted.\n";
        return false;
    }
    */
}
