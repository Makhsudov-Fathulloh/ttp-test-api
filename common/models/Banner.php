<?php

namespace common\models;

use common\behaviors\SlugBehavior;
use common\models\query\BannerQuery;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string $link
 * @property int|null $sort
 * @property int|null $lang
 * @property string|null $lang_hash
 * @property int|null $file_id
 * @property int|null $target
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File $file
 */
class Banner extends UploadFile
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
        return 'banner';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'slug' => [
                'class' => SlugBehavior::class,
                'attribute' => 'slug',
                'attribute_title' => 'title',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'sort', 'lang', 'lang_hash', 'file_id', 'target', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['title', 'link'], 'required'],
            [['sort', 'lang', 'file_id', 'target', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title', 'slug', 'link'], 'string', 'max' => 255],
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
            'link' => Yii::t('app', 'Link'),
            'sort' => Yii::t('app', 'Sort'),
            'lang' => Yii::t('app', 'Lang'),
            'lang_hash' => Yii::t('app', 'Lang Hash'),
            'file_id' => Yii::t('app', 'File ID'),
            'target' => Yii::t('app', 'Target'),
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
     * @return BannerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BannerQuery(get_called_class());
    }

}
