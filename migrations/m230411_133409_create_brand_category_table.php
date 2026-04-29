<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%brand_category}}`.
 */
class m230411_133409_create_brand_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%brand_category}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'producer_id' => $this->integer(),
        ]);

        // creates index for column `producer_id`
        $this->createIndex(
            'idx-brand_category-producer_id',
            'brand_category',
            'producer_id'
        );

        // add foreign key for table `producer`
        $this->addForeignKey(
            'fku-brand_category-producer_id',
            'brand_category',
            'producer_id',
            'producer',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-brand_category-category_id',
            'brand_category',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fku-brand_category-category_id',
            'brand_category',
            'category_id',
            'category',
            'id',
            'SET NULL',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%brand_category}}');
    }
}
