<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m231121_122020_add_class_table
 */
class m231121_122020_add_class_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%c_class}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_CHAR,
            
        ]);

        $this->addColumn('{{%user}}', 'class_id', $this->integer()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231121_122020_add_class_table cannot be reverted.\n";

        return false;
    }

}
