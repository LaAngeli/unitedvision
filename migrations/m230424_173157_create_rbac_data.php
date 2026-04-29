<?php

use yii\db\Migration;

/**
 * Class m230424_173157_create_rbac_data
 */
class m230424_173157_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $auth = Yii::$app->authManager;

        // add "createContent" permission
        $createContent = $auth->createPermission('addContent');
        $createContent->description = 'Add content';
        $auth->add($createContent);

        // add "updateContent" permission
        $updateContent = $auth->createPermission('updateContent');
        $updateContent->description = 'update content';
        $auth->add($updateContent);

        // add "viewContent" permission
        $viewContent = $auth->createPermission('viewContent');
        $viewContent->description = 'view content';
        $auth->add($viewContent);


        // add "deleteContent" permission
        $deleteContent = $auth->createPermission('deleteContent');
        $deleteContent->description = 'delete content';
        $auth->add($deleteContent);




        //create role admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        //create role moderator
        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);


        // moderator permissions
        $auth->addChild($moderator, $createContent);
        $auth->addChild($moderator, $updateContent);
        $auth->addChild($moderator, $viewContent);

        //admin permission
        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $deleteContent);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230424_173157_create_rbac_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230424_173157_create_rbac_data cannot be reverted.\n";

        return false;
    }
    */
}
