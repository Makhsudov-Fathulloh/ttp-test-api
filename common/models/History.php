<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $description
 * @property int|null $type
 * @property int|null $file_id
 * @property string|null $documents
 * @property string|null $anons
 * @property string|null $content
 * @property int|null $lang
 * @property string|null $lang_hash
 * @property int|null $status
 * @property int|null $views
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File $file
 */
class History extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'description', 'type', 'file_id', 'documents', 'anons', 'content', 'lang', 'lang_hash', 'views', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['type', 'file_id', 'lang', 'status', 'views', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['title', 'slug', 'description', 'documents', 'anons', 'content'], 'string', 'max' => 255],
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
            'slug' => Yii::t('app', 'Slug'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Type'),
            'file_id' => Yii::t('app', 'File ID'),
            'documents' => Yii::t('app', 'Documents'),
            'anons' => Yii::t('app', 'Anons'),
            'content' => Yii::t('app', 'Content'),
            'lang' => Yii::t('app', 'Lang'),
            'lang_hash' => Yii::t('app', 'Lang Hash'),
            'status' => Yii::t('app', 'Status'),
            'views' => Yii::t('app', 'Views'),
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
     * @return \common\models\query\HistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\HistoryQuery(get_called_class());
    }

}
