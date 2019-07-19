<?php

use yii\db\Migration;

class m171115_171609_advert extends Migration {
    public function safeUp() {
        $this->addColumn('advert', 'adv_active', 'ENUM("active", "block") NOT NULL DEFAULT "active"');
    }

    public function safeDown() {
        $this->dropColumn('advert', 'adv_active');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171115_171609_advert cannot be reverted.\n";
        return false;
    }
    */
}
