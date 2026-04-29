<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%site_info}}`.
 */
class m230714_140737_create_site_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%site_info}}', [
            'id' => $this->primaryKey(),
            'site_name' => $this->string(255),
            'logo_header' => $this->string(255),
            'logo_footer' => $this->string(255),
            'footer_text' => $this->string(255),
            'site_image' => $this->string(255),
            'phone_number' => $this->string(255),
            'address' => $this->string(255),
            'map_location' => $this->text(),
            'email' => $this->string(255),
            'min_description' => $this->string(255),
            'max_description' => $this->text(),
            'updated_by'  => $this->integer(11),
            'updated_at' => $this->dateTime()
        ]);


        // creates index for column `updated_by`
        $this->createIndex(
            'idx-site_info-updated_by',
            'site_info',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fku-site_info-updated_by',
            'site_info',
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
        $this->dropTable('{{%site_info}}');
    }
}
