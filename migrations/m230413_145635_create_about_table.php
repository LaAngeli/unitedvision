<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%about}}`.
 */
class m230413_145635_create_about_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%about}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description_min' => $this->text(),
            'description_max' => $this->text(),
            'image' => $this->string(255),
            'status' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by'  => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            'idx-about-created_by',
            'about',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-about-created_by',
            'about',
            'created_by',
            'user',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-about-updated_by',
            'about',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-about-updated_by',
            'about',
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
        $this->dropTable('{{%about}}');
    }
}
