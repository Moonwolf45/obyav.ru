<?php

use yii\db\Migration;
use yii\db\Schema;

class m171109_185811_advert extends Migration {
    public function safeUp() {
        $this->addColumn('advert', 'city', Schema::TYPE_STRING . ' NOT NULL');
    }

    public function safeDown() {
        $this->dropColumn('advert', 'city');
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
