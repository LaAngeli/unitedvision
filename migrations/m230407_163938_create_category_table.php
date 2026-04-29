<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m230407_163938_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description_min' => $this->text(),
            'description_max' => $this->text(),
            'image' => $this->string(255),
            'status' => $this->integer(11),
            'producer_id' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by'  => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            'idx-category-created_by',
            'category',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-category-created_by',
            'category',
            'created_by',
            'user',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-category-updated_by',
            'category',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-category-updated_by',
            'category',
            'updated_by',
            'user',
            'id',
            'SET NULL',
            'RESTRICT'
        );


        // creates index for column `producer_id`
        $this->createIndex(
            'idx-category-producer_id',
            'category',
            'producer_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-category-producer_id',
            'category',
            'producer_id',
            'producer',
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
        $this->dropTable('{{%category}}');
    }
}
