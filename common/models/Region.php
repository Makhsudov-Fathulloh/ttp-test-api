<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $code
 * @property int|null $country_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property Station[] $stations
 */
class Region extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code', 'country_id', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['code', 'country_id', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'country_id' => Yii::t('app', 'Country ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Stations]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\StationQuery
     */
    public function getStations()
    {
        return $this->hasMany(Station::class, ['region_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RegionQuery(get_called_class());
    }

}
