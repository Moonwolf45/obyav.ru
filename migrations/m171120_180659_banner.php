<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m171120_180659_banner
 */
class m171120_180659_banner extends Migration {
    /**
     * @inheritdoc
     */
    public function safeUp() {
        $this->addColumn('banner', 'date_create', Schema::TYPE_DATE . ' NOT NULL');
        $this->addColumn('banner', 'date_end', Schema::TYPE_DATE . ' NOT NULL');
        $this->addColumn('banner', 'name', Schema::TYPE_STRING . ' NOT NULL');
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->dropColumn('banner', 'date_create');
        $this->dropColumn('banner', 'date_end');
        $this->dropColumn('banner', 'name');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171120_180659_banner cannot be reverted.\n";
        return false;
    }
    */
}
