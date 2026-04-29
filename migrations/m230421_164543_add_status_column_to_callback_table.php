<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%callback}}`.
 */
class m230421_164543_add_status_column_to_callback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%callback}}', 'status', $this->integer(11)->after('phone'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%callback}}', 'status');
    }
}
