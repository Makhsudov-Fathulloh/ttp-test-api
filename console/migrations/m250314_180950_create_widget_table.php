<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%widget}}`.
 */
class m250314_180950_create_widget_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%widget}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'alias' => $this->string(255),
            'type' => $this->string(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(32),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%widget}}');
    }
}
