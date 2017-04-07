<?php

namespace console\migrations;

use yii\db\Migration;

class M170405164653CartItem extends Migration
{
    public function up()
    {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '';

        $this->createTable('{{%orderItem}}', [
            'id' => $this->primaryKey(),
            'orderId' => $this->smallInteger()->notNull(),
            'productId' => $this->smallInteger()->notNull(),
            'amount' => $this->smallInteger()->notNull(),
            'price' => $this->float()->notNull(),
            'createdAt' => $this->dateTime()->notNull(),
            'updatedAt' => $this->dateTime(),
            'deletedAt' => $this->dateTime(),
        ], $tableOptions);

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'name' => $this->string(128),
            'phone' => $this->string(128),
            'email' => $this->string(128),
            'address' => $this->string(128),
            'fullPrice' => $this->float()->notNull()->defaultValue(0),
            'discount' => $this->float()->notNull()->defaultValue(0),
            'deliveryCost' => $this->float()->notNull()->defaultValue(0),
            'taxCost' => $this->float()->notNull()->defaultValue(0),
            'totalPrice' => $this->float()->notNull()->defaultValue(0),
            'createdAt' => $this->dateTime()->notNull(),
            'updatedAt' => $this->dateTime(),
            'deletedAt' => $this->dateTime(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%order}}');
        $this->dropTable('{{%orderItem}}');
    }
}
