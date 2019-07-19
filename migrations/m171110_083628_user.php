<?php

use yii\db\Migration;
use yii\db\Schema;

class m171110_083628_user extends Migration {
    public function safeUp() {
        $this->addColumn('user', 'password', Schema::TYPE_STRING . ' NOT NULL');
    }

    public function safeDown() {
        $this->dropColumn('user', 'password');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171110_083628_user cannot be reverted.\n";
        return false;
    }
    */
}
