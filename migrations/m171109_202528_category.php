<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_202528_category extends Migration {
    public function safeUp() {
        $this->addColumn('category', 'transliter', Schema::TYPE_STRING . ' NOT NULL');
    }

    public function safeDown() {
        $this->dropColumn('category', 'transliter');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171109_202528_category cannot be reverted.\n";
        return false;
    }
    */
}
