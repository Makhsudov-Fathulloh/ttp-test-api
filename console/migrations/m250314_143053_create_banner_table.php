<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banner}}`.
 */
class m250314_143053_create_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner}}', [
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

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-banner-file_id',
            'banner',
            'file_id'
        );

        $this->addForeignKey(
            'fk-banner-file_id',
            'banner',
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
            'fk-banner-file_id',
            '{{%banner}}'
        );

        $this->dropIndex(
            'idx-banner-file_id',
            '{{%banner}}'
        );

        $this->dropTable('{{%banner}}');
    }
}
