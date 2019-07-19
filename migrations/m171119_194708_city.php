<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m171119_194708_city
 */
class m171119_194708_city extends Migration {
    /**
     * @inheritdoc
     */
    public function safeUp() {
        $this->createTable('city', [
            'id'    => Schema::TYPE_PK,
            'name'  => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        echo "m171119_194708_city не может быть возвращено.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up() {

    }

    public function down() {
        echo "m171119_194708_city cannot be reverted.\n";
        return false;
    }
    */
}
