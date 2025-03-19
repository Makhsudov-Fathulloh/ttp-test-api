<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%station}}`.
 */
class m250315_100757_create_station_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%station}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'slug' => $this->string(255),
            'address' => $this->string(255),
            'phone' => $this->string(16),
            'fax' => $this->string(255),
            'email' => $this->string(255),
            'region_id' => $this->integer(),
            'file_id' => $this->integer(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(32),
            'lat' => $this->string(255),
            'long' => $this->string(255),
            'status' => $this->integer()->defaultValue(9),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-station-region_id',
            'station',
            'region_id'
        );

        $this->addForeignKey(
            'fk-station-region_id',
            'station',
            'region_id',
            'region',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-station-file_id',
            'station',
            'file_id'
        );

        $this->addForeignKey(
            'fk-station-file_id',
            'station',
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
            'fk-station-region_id',
            '{{%station}}'
        );

        $this->dropIndex(
            'idx-station-region_id',
            '{{%station}}'
        );

        $this->dropForeignKey(
            'fk-station-file_id',
            '{{%station}}'
        );

        $this->dropIndex(
            'idx-station-file_id',
            '{{%station}}'
        );

        $this->dropTable('{{%station}}');
    }
}
