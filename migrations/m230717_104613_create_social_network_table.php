<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%social_network}}`.
 */
class m230717_104613_create_social_network_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%social_network}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'icon' => $this->string(255),
            'url' => $this->string(500),
            'created_by' => $this->integer(11),
            'updated_by'  => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);


        // creates index for column `created_by`
        $this->createIndex(
            'idx-social_network-created_by',
            'social_network',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-social_network-created_by',
            'social_network',
            'created_by',
            'user',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-social_network-updated_by',
            'social_network',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-social_network-updated_by',
            'social_network',
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
        $this->dropTable('{{%social_network}}');
    }
}
