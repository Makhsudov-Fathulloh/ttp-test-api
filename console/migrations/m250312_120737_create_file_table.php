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
            'folder' => $this->string(255),
            'domain' => $this->string(255),
            'user_id' => $this->integer(),
            'path' => $this->string(),
            'size' => $this->integer(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'downloads' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-file-user_id',
            'file',
            'user_id'
        );

        $this->addForeignKey(
            'fk-file-user_id',
            'file',
            'user_id',
            'user',
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
            'fk-file-user_id',
            '{{%menu_item}}'
        );

        $this->dropIndex(
            'idx-file-user_id',
            '{{%file}}'
        );

        $this->dropTable('{{%file}}');
    }
}
