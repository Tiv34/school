<?php

use yii\db\Migration;

/**
 * Class m230731_085913_user_add_admin_panel
 */
class m230731_085913_user_add_admin_panel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'admin', $this->boolean()->defaultValue(false));
        $this->addColumn('{{%user}}', 'name', $this->char(100)->defaultValue(null));
        $this->addColumn('{{%user}}', 'surname', $this->char(100)->defaultValue(null));
        $this->addColumn('{{%user}}', 'phone', $this->char(12)->defaultValue(null));
        $this->addColumn('{{%user}}', 'timezone', $this->char(55)->defaultValue('Europe/Moscow'));
        $this->addColumn('{{%user}}', 'city', $this->char(55)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'admin');
        $this->dropColumn('{{%user}}', 'name');
        $this->dropColumn('{{%user}}', 'surname');
        $this->dropColumn('{{%user}}', 'phone');
        $this->dropColumn('{{%user}}', 'timezone');
        $this->dropColumn('{{%user}}', 'city');

        echo "m230731_085913_user_add_admin_panel reverted done.\n";
    }

}
