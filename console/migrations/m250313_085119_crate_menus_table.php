<?php

use yii\db\Migration;

class m250313_085119_crate_menus_table extends Migration
{
    public function safeUp()
    {
        $this->createTable("menus", [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'alias' => $this->string(255),
            'type' => $this->string(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(32),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ]);

        $this->batchInsert('{{%menus}}', [
                'title',
                'alias',
                'status',
                'created_at',
                'updated_at',
            ],
            [
                [
                    'header-nav',
                    'header-nav',
                    \common\models\Menus::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
                [
                    'additional-menu',
                    'additional-menu',
                    \common\models\Menus::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
                [
                    'useful-menu',
                    'additional-menu',
                    \common\models\Menus::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
                [
                    'footer-nav__right',
                    'footer-nav',
                    \common\models\Menus::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
                [
                    'footer-nav__left',
                    'footer-nav',
                    \common\models\Menus::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable("menus");
    }
}