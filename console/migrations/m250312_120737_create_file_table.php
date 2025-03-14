<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file}}`.
 */
class m250312_120737_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->string(),
            'file' => $this->string(255),
            'ext' => $this->string(16),
            'slug' => $this->string(255),
            'folder' => $this->string(255),
            'domain' => $this->string(255),
            'user_id' => $this->integer(),
            'folder_id' => $this->integer(),
            'path' => $this->string(),
            'size' => $this->integer(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'downloads' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-file-folder_id',
            'file',
            'folder_id'
        );

        $this->addForeignKey(
            'fk-file-folder_id',
            'file',
            'folder_id',
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
            'fk-file-folder_id',
            '{{%file}}'
        );

        $this->dropIndex(
            'idx-file-folder_id',
            '{{%file}}'
        );

        $this->dropTable('{{%file}}');
    }
}
