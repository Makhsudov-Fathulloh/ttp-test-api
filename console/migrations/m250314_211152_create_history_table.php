<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m250314_211152_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'slug' => $this->string(255),
            'description' => $this->string(),
            'type' => $this->integer(),
            'file_id' => $this->integer(),
            'documents' => $this->string(),
            'anons' => $this->string(),
            'content' => $this->string(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(32),
            'status' => $this->integer()->defaultValue(9),
            'views' => $this->integer(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-history-file_id',
            'history',
            'file_id'
        );

        $this->addForeignKey(
            'fk-history-file_id',
            'history',
            'file_id',
            'file',
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
            'fk-history-file_id',
            '{{%history}}'
        );

        $this->dropIndex(
            'idx-history-file_id',
            '{{%history}}'
        );

        $this->dropTable('{{%history}}');
    }
}
