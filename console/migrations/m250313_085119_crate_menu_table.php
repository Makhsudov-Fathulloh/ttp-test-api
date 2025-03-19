<?php

use yii\db\Migration;

class m250313_085119_crate_menu_table extends Migration
{
    public function safeUp()
    {
        $this->createTable("menu", [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'alias' => $this->string(255),
            'type' => $this->integer(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(32),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->batchInsert('{{%menu}}', [
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
                    \common\models\Menu::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
                [
                    'additional-menu',
                    'additional-menu',
                    \common\models\Menu::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
                [
                    'useful-menu',
                    'additional-menu',
                    \common\models\Menu::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
                [
                    'footer-nav__right',
                    'footer-nav',
                    \common\models\Menu::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
                [
                    'footer-nav__left',
                    'footer-nav',
                    \common\models\Menu::STATUS_ACTIVE,
                    date('U'),
                    date('U')
                ],
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable("menu");
    }
}