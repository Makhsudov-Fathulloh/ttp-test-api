<?php

use yii\db\Migration;

class m250313_113555_crate_menu_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("menu_item", [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer(),
            'title' => $this->string()->notNull(),
            'url' => $this->string(255)->defaultValue('#'),
            'file_id' => $this->integer(),
            'sort' => $this->integer(),
            'menu_id_parent_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-menu_item-menu_id',
            'menu_item',
            'menu_id'
        );

        $this->addForeignKey(
            'fk-menu_item-menu_id',
            'menu_item',
            'menu_id',
            'menu',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-menu_item-file_id',
            'menu_item',
            'file_id'
        );

        $this->addForeignKey(
            'fk-menu_item-file_id',
            'menu_item',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-menu_item-menu_id_parent_id',
            'menu_item',
            'menu_id_parent_id'
        );

        $this->addForeignKey(
            'fk-menu_item-menu_id_parent_id',
            'menu_item',
            'menu_id_parent_id',
            'menu_item',
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
            'fk-menu_item-menu_id',
            '{{%menu_item}}'
        );

        $this->dropIndex(
            'idx-menu_item-menu_id',
            '{{%menu_item}}'
        );

        $this->dropForeignKey(
            'fk-menu_item-file_id',
            '{{%menu_item}}'
        );

        $this->dropIndex(
            'idx-menu_item-file_id',
            '{{%menu_item}}'
        );

        $this->dropForeignKey(
            'fk-menu_item-menu_id_parent_id',
            '{{%menu_item}}'
        );

        $this->dropIndex(
            'idx-menu_item-menu_id_parent_id',
            '{{%menu_item}}'
        );

        $this->dropTable("menu_item");
    }
}