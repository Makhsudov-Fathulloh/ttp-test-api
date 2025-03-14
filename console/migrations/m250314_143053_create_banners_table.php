<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banners}}`.
 */
class m250314_143053_create_banners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banners}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string(255),
            'link' => $this->string()->notNull(),
            'sort' => $this->integer(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(32),
            'file_id' => $this->integer(),
            'target' => $this->integer(),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-banners-file_id',
            'banners',
            'file_id'
        );

        $this->addForeignKey(
            'fk-banners-file_id',
            'banners',
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
            'fk-banners-file_id',
            '{{%banners}}'
        );

        $this->dropIndex(
            'idx-banners-file_id',
            '{{%banners}}'
        );

        $this->dropTable('{{%banners}}');
    }
}
