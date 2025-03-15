<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m250315_004054_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'slug' => $this->string(255),
            'description' => $this->string(),
            'type' => $this->integer(),
            'file_id' => $this->integer(),
            'top' => $this->integer(),
            'user_id' => $this->integer(),
            'video' => $this->string(),
            'documents' => $this->string(),
            'content' => $this->string(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(32),
            'status' => $this->integer()->defaultValue(9),
            'views' => $this->integer(),

            'published_at' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-post-file_id',
            'post',
            'file_id'
        );

        $this->addForeignKey(
            'fk-post-file_id',
            'post',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-post-user_id',
            'post',
            'user_id'
        );

        $this->addForeignKey(
            'fk-post-user_id',
            'post',
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
            'fk-post-file_id',
            '{{%post}}'
        );

        $this->dropIndex(
            'idx-post-file_id',
            '{{%post}}'
        );

        $this->dropForeignKey(
            'fk-post-user_id',
            '{{%post}}'
        );

        $this->dropIndex(
            'idx-post-user_id',
            '{{%post}}'
        );

        $this->dropTable('{{%post}}');
    }
}
