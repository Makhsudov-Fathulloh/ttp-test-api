<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_token}}`.
 */
class m250312_120133_create_user_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'token' => $this->string(32),
            'expires_at' => $this->string(32),
            'refresh_token' => $this->string(32),
            'refresh_token_expires_at' => $this->string(32),
        ]);

        $this->createIndex(
            'idx-user_token-user_id',
            'user_token',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_token-user_id',
            'user_token',
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
            'fk-user_token-user_id',
            '{{%user_token}}'
        );

        $this->dropIndex(
            'idx-user_token-user_id',
            '{{%user_token}}'
        );

        $this->dropTable('{{%user_token}}');
    }
}
