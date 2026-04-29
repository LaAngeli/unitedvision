<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%main_banner}}`.
 */
class m230718_115605_add_status_column_to_main_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%main_banner}}', 'status', $this->integer(11)->after('url'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%main_banner}}', 'status');
    }
}
