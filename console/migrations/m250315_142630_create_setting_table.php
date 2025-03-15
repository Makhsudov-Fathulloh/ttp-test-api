<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%setting}}`.
 */
class m250315_142630_create_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'alias' => $this->string(255),
            'value' => $this->string(255),
            'link' => $this->string(255),
            'file_id' => $this->integer(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(32),
            'sort' => $this->integer(),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-setting-file_id',
            'setting',
            'file_id'
        );

        $this->addForeignKey(
            'fk-setting-file_id',
            'setting',
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
            'fk-setting-file_id',
            '{{%setting}}'
        );

        $this->dropIndex(
            'idx-setting-file_id',
            '{{%setting}}'
        );

        $this->dropTable('{{%setting}}');
    }
}
