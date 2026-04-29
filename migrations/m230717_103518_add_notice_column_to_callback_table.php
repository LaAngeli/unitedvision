<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%callback}}`.
 */
class m230717_103518_add_notice_column_to_callback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%callback}}', 'notice', $this->text()->after('phone'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%callback}}', 'notice');
    }
}
