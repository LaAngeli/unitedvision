<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%reviews}}`.
 */
class m230718_134744_add_status_column_to_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%reviews}}', 'status', $this->integer(11)->after('review'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%reviews}}', 'status');
    }
}
