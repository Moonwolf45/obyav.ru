<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_164530_category extends Migration {
    public function safeUp() {
        $this->alterColumn('category', 'images', Schema::TYPE_STRING . ' NOT NULL DEFAULT "no_photo.png"');
    }

    public function safeDown() {
        $this->alterColumn('category', 'images', Schema::TYPE_STRING . ' DEFAULT "no_photo.png"');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171109_164530_category cannot be reverted.\n";
        return false;
    }
    */
}
