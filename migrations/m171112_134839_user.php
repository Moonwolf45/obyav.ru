<?php

use yii\db\Migration;
use yii\db\Schema;

class m171112_134839_user extends Migration {
    public function safeUp() {
        $this->addColumn('user', 'auth_key', Schema::TYPE_STRING);
    }

    public function safeDown() {
        $this->dropColumn('user', 'auth_key');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171112_134839_user cannot be reverted.\n";
        return false;
    }
    */
}
