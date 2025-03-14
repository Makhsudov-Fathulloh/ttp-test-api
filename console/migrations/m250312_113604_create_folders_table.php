<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%folders}}`.
 */
class m250312_113604_create_folders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%folders}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'alias' => $this->string(255),
            'parent_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-folders-parent_id',
            'folders',
            'parent_id'
        );

        $this->addForeignKey(
            'fk-folders-parent_id',
            'folders',
            'parent_id',
            'folders',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-folders-parent_id',
            '{{%folders}}'
        );

        $this->dropIndex(
            'idx-folders-parent_id',
            '{{%folders}}'
        );

        $this->dropTable('{{%folders}}');
    }
}
