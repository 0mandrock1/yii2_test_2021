<?php

use yii\db\Migration;

/**
 * Class m211027_082201_update_user_table
 */
class m211027_082201_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_user_group_idx',
            'user',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_group_idx','user');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211027_082201_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
