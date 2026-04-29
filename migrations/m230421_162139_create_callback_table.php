<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%callback}}`.
 */
class m230421_162139_create_callback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%callback}}', [
            'id' => $this->primaryKey(),
            'initials' => $this->string(255),
            'email' => $this->string(255),
            'phone' => $this->string(255),
            'updated_by' => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-callback-updated_by',
            'callback',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-callback-updated_by',
            'callback',
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
        $this->dropTable('{{%callback}}');
    }
}
