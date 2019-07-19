<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_191804_category extends Migration {
    public function safeUp() {
        $this->alterColumn('category', 'parent_id', Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL DEFAULT 0');
    }

    public function safeDown() {
        $this->alterColumn('category', 'parent_id', Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171109_191804_category cannot be reverted.\n";
        return false;
    }
    */
}
