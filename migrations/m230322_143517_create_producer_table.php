<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%producer}}`.
 */
class m230322_143517_create_producer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%producer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'description_min' => $this->text(),
            'description_max' => $this->text(),
            'image_logo' => $this->string(255),
            'image_brand' => $this->string(255),
            'image_slider_big' => $this->string(255),
            'image_slider_small' => $this->string(255),
            'image_video_preview' => $this->string(255),
            'video_url' => $this->string(500),
            'status' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by'  => $this->integer(11),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            'idx-producer-created_by',
            'producer',
            'created_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-producer-created_by',
            'producer',
            'created_by',
            'user',
            'id',
            'SET NULL',
            'RESTRICT'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-producer-updated_by',
            'producer',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-producer-updated_by',
            'producer',
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
        $this->dropTable('{{%producer}}');
    }
}
