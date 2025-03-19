<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%widget_item}}`.
 */
class m250314_183547_create_widget_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%widget_item}}', [
            'id' => $this->primaryKey(),
            'widget_id' => $this->integer()->notNull(),
            'title' => $this->string(255),
            'description' => $this->string(),
            'secondary' => $this->string(255),
            'file_id' => $this->integer(),
            'sort' => $this->integer(),
            'parent_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-widget_item-widget_id',
            'widget_item',
            'widget_id'
        );

        $this->addForeignKey(
            'fk-widget_item-widget_id',
            'widget_item',
            'widget_id',
            'widget',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-widget_item-file_id',
            'widget_item',
            'file_id'
        );

        $this->addForeignKey(
            'fk-widget_item-file_id',
            'widget_item',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-widget_item-parent_id',
            'widget_item',
            'parent_id'
        );

        $this->addForeignKey(
            'fk-widget_item-parent_id',
            'widget_item',
            'parent_id',
            'widget_item',
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
            'fk-widget_item-widget_id',
            '{{%widget_item}}'
        );

        $this->dropIndex(
            'idx-widget_item-widget_id',
            '{{%widget_item}}'
        );

        $this->dropForeignKey(
            'fk-widget_item-file_id',
            '{{%widget_item}}'
        );

        $this->dropIndex(
            'idx-widget_item-file_id',
            '{{%widget_item}}'
        );

        $this->dropForeignKey(
            'fk-widget_item-parent_id',
            '{{%widget_item}}'
        );

        $this->dropIndex(
            'idx-widget_item-parent_id',
            '{{%widget_item}}'
        );

        $this->dropTable('{{%widget_item}}');
    }
}
