<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%widget_items}}`.
 */
class m250314_183547_create_widget_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%widget_items}}', [
            'id' => $this->primaryKey(),
            'widget_id' => $this->integer()->notNull(),
            'title' => $this->string(255),
            'description' => $this->string(),
            'secondary' => $this->string(255),
            'file_id' => $this->integer(),
            'sort' => $this->integer(),
            'parent_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-widget_items-widget_id',
            'widget_items',
            'widget_id'
        );

        $this->addForeignKey(
            'fk-widget_items-widget_id',
            'widget_items',
            'widget_id',
            'widgets',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-widget_items-file_id',
            'widget_items',
            'file_id'
        );

        $this->addForeignKey(
            'fk-widget_items-file_id',
            'widget_items',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-widget_items-parent_id',
            'widget_items',
            'parent_id'
        );

        $this->addForeignKey(
            'fk-widget_items-parent_id',
            'widget_items',
            'parent_id',
            'widget_items',
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
            'fk-widget_items-widget_id',
            '{{%widget_items}}'
        );

        $this->dropIndex(
            'idx-widget_items-widget_id',
            '{{%widget_items}}'
        );

        $this->dropForeignKey(
            'fk-widget_items-file_id',
            '{{%widget_items}}'
        );

        $this->dropIndex(
            'idx-widget_items-file_id',
            '{{%widget_items}}'
        );

        $this->dropForeignKey(
            'fk-widget_items-parent_id',
            '{{%widget_items}}'
        );

        $this->dropIndex(
            'idx-widget_items-parent_id',
            '{{%widget_items}}'
        );

        $this->dropTable('{{%widget_items}}');
    }
}
