<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 */
class m230714_140803_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'initials' => $this->string(255),
            'image' => $this->string(255),
            'review' => $this->text(),
            'created_by' => $this->integer(11),
            'updated_by'  => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            'idx-reviews-created_by',
            'reviews',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-reviews-created_by',
            'reviews',
            'created_by',
            'user',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-reviews-updated_by',
            'reviews',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-reviews-updated_by',
            'reviews',
            'updated_by',
            'user',
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
        $this->dropTable('{{%reviews}}');
    }
}
