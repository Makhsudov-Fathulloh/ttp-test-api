<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "station".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $email
 * @property int|null $region_id
 * @property int|null $file_id
 * @property int|null $lang
 * @property string|null $lang_hash
 * @property string|null $lat
 * @property string|null $long
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File $file
 * @property Region $region
 */
class Station extends UploadFile
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $document;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'station';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'address', 'phone', 'fax', 'email', 'region_id', 'file_id', 'lang', 'lang_hash', 'lat', 'long', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['region_id', 'file_id', 'lang', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title', 'slug', 'address', 'fax', 'email', 'lat', 'long'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 16],
            [['lang_hash'], 'string', 'max' => 32],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
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
            'slug' => Yii::t('app', 'Slug'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'region_id' => Yii::t('app', 'Region ID'),
            'file_id' => Yii::t('app', 'File ID'),
            'lang' => Yii::t('app', 'Lang'),
            'lang_hash' => Yii::t('app', 'Lang Hash'),
            'lat' => Yii::t('app', 'Lat'),
            'long' => Yii::t('app', 'Long'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FileQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::class, ['id' => 'file_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RegionQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\StationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\StationQuery(get_called_class());
    }

}
