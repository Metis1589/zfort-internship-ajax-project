<?php

namespace console\migrations;

use yii\db\Migration;

class M190708094243TechReport extends Migration
{
    public function safeUp()
    {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '';

        $this->createTable('{{%techReport}}', [
            'id' => $this->primaryKey(),
            'request' => $this->text()->notNull(),
            'response' => $this->text()->notNull(),
            'statusCode' => $this->smallInteger()->notNull(),
            'action' => $this->string(128)->notNull(),
            'dateTime' => $this->dateTime()->notNull(),
            'createdAt' => $this->dateTime()->notNull(),
            'updatedAt' => $this->dateTime(),
            'deletedAt' => $this->dateTime(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%techReport}}');
    }
}
