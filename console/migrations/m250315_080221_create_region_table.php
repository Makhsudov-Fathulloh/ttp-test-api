<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region}}`.
 */
class m250315_080221_create_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'code' => $this->integer(),
            'country_id' => $this->integer(),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
        ]);

//        $this->createIndex(
//            'idx-region-country_id',
//            'region',
//            'country_id'
//        );
//
//        $this->addForeignKey(
//            'fk-region-country_id',
//            'region',
//            'country_id',
//            'country',
//            'id',
//            'CASCADE'
//        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
//        $this->dropForeignKey(
//            'fk-region-country_id',
//            '{{%region}}'
//        );
//
//        $this->dropIndex(
//            'idx-region-country_id',
//            '{{%region}}'
//        );

        $this->dropTable('{{%region}}');
    }
}
