<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_163215_advert extends Migration {
    public function safeUp() {
        $this->alterColumn('advert', 'name', Schema::TYPE_STRING . ' NOT NULL');
        $this->alterColumn('advert', 'price', Schema::TYPE_DECIMAL . ' NOT NULL');
    }

    public function safeDown() {
        $this->alterColumn('advert', 'name', Schema::TYPE_STRING);
        $this->alterColumn('advert', 'price', Schema::TYPE_DECIMAL);
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171109_163215_advert cannot be reverted.\n";
        return false;
    }
    */
}
