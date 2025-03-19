<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $alias
 * @property string|null $value
 * @property string|null $link
 * @property int|null $file_id
 * @property int|null $lang
 * @property string|null $lang_hash
 * @property int|null $sort
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File $file
 */
class Setting extends UploadFile
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
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'value', 'link', 'file_id', 'lang', 'lang_hash', 'sort', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['file_id', 'lang', 'sort', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title', 'alias', 'value', 'link'], 'string', 'max' => 255],
            [['lang_hash'], 'string', 'max' => 32],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
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
            'alias' => Yii::t('app', 'Alias'),
            'value' => Yii::t('app', 'Value'),
            'link' => Yii::t('app', 'Link'),
            'file_id' => Yii::t('app', 'File ID'),
            'lang' => Yii::t('app', 'Lang'),
            'lang_hash' => Yii::t('app', 'Lang Hash'),
            'sort' => Yii::t('app', 'Sort'),
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
     * {@inheritdoc}
     * @return \common\models\query\SettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SettingQuery(get_called_class());
    }

}
