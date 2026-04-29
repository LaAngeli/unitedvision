<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%main_banner}}`.
 */
class m230717_105032_create_main_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%main_banner}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'image_desktop' => $this->string(255),
            'image_mobile' => $this->string(255),
            'url' => $this->string(500),
            'created_by' => $this->integer(11),
            'updated_by'  => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);


        // creates index for column `created_by`
        $this->createIndex(
            'idx-main_banner-created_by',
            'main_banner',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-main_banner-created_by',
            'main_banner',
            'created_by',
            'user',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-main_banner-updated_by',
            'main_banner',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-main_banner-updated_by',
            'main_banner',
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
        $this->dropTable('{{%main_banner}}');
    }
}
