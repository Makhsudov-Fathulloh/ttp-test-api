<?php

use yii\db\Migration;

class m250313_113555_crate_menu_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("menu_items", [
            'id' => $this->primaryKey(),
            'menu_id' => $this->integer()->notNull(),
            'title' => $this->json()->notNull(),
            'url' => $this->string(255)->defaultValue('#'),
            'file_id' => $this->integer(),
            'sort' => $this->integer(),
            'menu_id_parent_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),

            'menu_items' => $this->json(),
        ]);

        $this->createIndex(
            'idx-menu_items-menu_id',
            'menu_items',
            'menu_id'
        );

        $this->addForeignKey(
            'fk-menu_items-menu_id',
            'menu_items',
            'menu_id',
            'menus',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-menu_items-file_id',
            'menu_items',
            'file_id'
        );

        $this->addForeignKey(
            'fk-menu_items-file_id',
            'menu_items',
            'file_id',
            'file',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-menu_items-menu_id_parent_id',
            'menu_items',
            'menu_id_parent_id'
        );

        $this->addForeignKey(
            'fk-menu_items-menu_id_parent_id',
            'menu_items',
            'menu_id_parent_id',
            'menu_items',
            'menu_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-menu_items-menu_id',
            '{{%menu_items}}'
        );

        $this->dropIndex(
            'idx-menu_items-menu_id',
            '{{%menu_items}}'
        );

        $this->dropForeignKey(
            'fk-menu_items-file_id',
            '{{%menu_items}}'
        );

        $this->dropIndex(
            'idx-menu_items-file_id',
            '{{%menu_items}}'
        );

        $this->dropForeignKey(
            'fk-menu_items-menu_id_parent_id',
            '{{%menu_items}}'
        );

        $this->dropIndex(
            'idx-menu_items-menu_id_parent_id',
            '{{%menu_items}}'
        );

        $this->dropTable("menu_items");
    }
}