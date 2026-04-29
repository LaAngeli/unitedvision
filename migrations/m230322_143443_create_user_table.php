<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230322_143443_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(255),
            'lastname' => $this->string(255),
            'password' => $this->string(255),
            'email' => $this->string(255)->unique(),
            'email_token' => $this->string(255),
            'reset_token' => $this->string(255),
            'auth_key' => $this->string(255),
            'status' => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
