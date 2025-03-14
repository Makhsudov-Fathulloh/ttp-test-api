<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(32),
            'last_name' => $this->string(32),
            'username' => $this->string(32)->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(9),
            'role' => $this->smallInteger()->notNull()->defaultValue(1),
            'phone' => $this->string(32)->unique(),
            'email' => $this->string(),

            'token' => $this->string(64),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string(64),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ], $tableOptions);

        $this->batchInsert('{{%user}}', [
                'first_name',
                'last_name',
                'username',
                'role',
                'status',
                'token',
                'auth_key',
                'password_hash',
                'password_reset_token',
                'created_at',
                'updated_at',
            ],
            [
                [
                    'Super',
                    'User',
                    'admin',
                    \common\models\User::ROLE_ADMIN,
                    \common\models\User::STATUS_ACTIVE,
                    Yii::$app->security->generateRandomString(64),
                    Yii::$app->security->generateRandomString(),
                    Yii::$app->security->generatePasswordHash('admin123'),
                    Yii::$app->security->generateRandomString() . '_' . time(),
                    date('U'),
                    date('U')
                ],
                [
                    'Normal',
                    'User',
                    'Manager',
                    \common\models\User::ROLE_ADMIN,
                    \common\models\User::STATUS_ACTIVE,
                    Yii::$app->security->generateRandomString(64),
                    Yii::$app->security->generateRandomString(),
                    Yii::$app->security->generatePasswordHash('manager123'),
                    Yii::$app->security->generateRandomString() . '_' . time(),
                    date('U'),
                    date('U')
                ],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}