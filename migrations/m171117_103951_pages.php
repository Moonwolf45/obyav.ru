<?php

use yii\db\Migration;
use yii\db\Schema;

class m171117_103951_pages extends Migration {
    public function safeUp() {
        $this->alterColumn('pages', 'description', Schema::TYPE_TEXT);
    }

    public function safeDown() {
        $this->alterColumn('pages', 'description', Schema::TYPE_STRING . ' NOT NULL');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171117_103951_pages cannot be reverted.\n";
        return false;
    }
    */
}
