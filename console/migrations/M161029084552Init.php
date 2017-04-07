<?php

namespace console\migrations;

use yii\db\Migration;

class M161029084552Init extends Migration
{

    public function up()
    {
        $tableOptions = ($this->db->driverName === 'mysql') ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : '';

        $this->createTable('{{%session}}', [
            'id' => $this->primaryKey(),
            'expire' => $this->integer()->notNull(),
            'data' => $this->binary()
        ], $tableOptions);

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'name' => $this->string(128)->notNull()->unique(),
            'slug' => $this->string(128)->notNull()->unique(),
            'productCount' => $this->smallInteger()->notNull()->defaultValue(0),
            'createdAt' => $this->dateTime()->notNull(),
            'updatedAt' => $this->dateTime(),
            'deletedAt' => $this->dateTime(),
            ], $tableOptions);

        $this->batchInsert('{{%category}}', ['id', 'status','name','slug','productCount','createdAt','updatedAt','deletedAt'],
        [
            [1, 1, 'Men', 'men', 2, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
            [2, 1, 'Women', 'women', 6, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
            [3, 1, 'Kids', 'kids', 2, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
            [4, 1, 'Fashion', 'fashion', 2, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00']
        ]);

        $this->createTable('{{%brand}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'name' => $this->string(128)->notNull()->unique(),
            'slug' => $this->string(128)->notNull()->unique(),
            'productCount' => $this->smallInteger()->notNull()->defaultValue(0),
            'createdAt' => $this->dateTime()->notNull(),
            'updatedAt' => $this->dateTime(),
            'deletedAt' => $this->dateTime(),
        ], $tableOptions);

        $this->batchInsert('{{%brand}}', ['id', 'status','name','slug','productCount','createdAt','updatedAt','deletedAt'],
            [
                [1, 1, 'Acne', 'acne', 2, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [2, 1, 'Grune Erde', 'grune-erde', 3, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [3, 1, 'Albiro', 'albiro', 5, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [4, 1, 'Ronhill', 'ronhill', 2, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00']
            ]);


        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'name' => $this->string(128)->notNull()->unique(),
            'image' => $this->string(128),
            'price' => $this->float()->notNull()->unique(),
            'priceOld' => $this->float()->notNull()->unique(),
            'slug' => $this->string(128)->notNull()->unique(),
            'categoryId' => $this->smallInteger()->notNull(),
            'brandId' => $this->smallInteger()->notNull(),
            'createdAt' => $this->dateTime()->notNull(),
            'updatedAt' => $this->dateTime(),
            'deletedAt' => $this->dateTime(),
        ], $tableOptions);

        $this->batchInsert('{{%product}}', ['id', 'status','name','slug','image','price','priceOld','categoryId','brandId','createdAt','updatedAt','deletedAt'],
            [
                [1, 1, 'Easy Polo Black Edition', 'easy-polo-black-edition', 'product12.jpg', 56, 56, 1, 1, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [2, 1, 'Easy Jeans Kids Edition', 'easy-jeans-kids-edition', 'product11.jpg', 120, 120, 3, 4, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [3, 1, 'Kids Model A Edition', 'kids-model-a-edition', 'product10.jpg', 76, 76, 3, 4, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [4, 1, 'Red Dress East Edition', 'red-dress-east-edition', 'product9.jpg', 203, 203, 2, 2, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [5, 1, 'Pink Dress', 'pink-dress', 'product8.jpg', 315, 315, 2, 3, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [6, 1, 'White Dress', 'white-dress', 'product7.jpg', 256, 256, 4, 2, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [7, 1, 'White Blouse', 'white-blouse', 'product6.jpg', 156, 156, 2, 3, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [8, 1, 'Blue Pullover', 'blue-pullover', 'product5.jpg', 175, 175, 2, 3, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [9, 1, 'Black Dress Office', 'black-dress-office', 'product4.jpg', 205, 205, 2, 3, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [10, 1, 'Black Dress Classic', 'black-dress-classic', 'product3.jpg', 195, 195, 4, 2, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [11, 1, 'Classic Men Pullover', 'classic-men-pullover', 'product2.jpg', 145, 145, 1, 1, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],
                [12, 1, 'Easy Jeans Women Edition', 'easy-jeans-women-edition', 'product1.jpg', 92, 92, 2, 3, '2017-03-05 00:00:00', '2017-03-05 00:00:00', '2017-03-05 00:00:00'],

            ]);

    }

    public function down()
    {
        $this->dropTable('{{%session}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%brand}}');
        $this->dropTable('{{%product}}');
    }

}
