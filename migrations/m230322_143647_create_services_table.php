<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 */
class m230322_143647_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description_min' => $this->text(),
            'description_max' => $this->text(),
            'image' => $this->string(255),
            'status' => $this->integer(11),
            'video_url' => $this->string(255),
            'created_by' => $this->integer(11),
            'updated_by'  => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            'idx-services-created_by',
            'services',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-services-created_by',
            'services',
            'created_by',
            'user',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-services-updated_by',
            'services',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-services-updated_by',
            'services',
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
        $this->dropTable('{{%services}}');
    }
}
