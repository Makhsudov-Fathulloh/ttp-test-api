<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%calls}}`.
 */
class m250315_145525_create_calls_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%calls}}', [
            'id' => $this->primaryKey(),
            'count' => $this->integer(),
            'ball' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%calls}}');
    }
}
