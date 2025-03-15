<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $description
 * @property int|null $type
 * @property int|null $file_id
 * @property int|null $top
 * @property int|null $user_id
 * @property string|null $video
 * @property string|null $documents
 * @property string|null $content
 * @property int|null $lang
 * @property string|null $lang_hash
 * @property int|null $status
 * @property int|null $views
 * @property int $published_at
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File $file
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'description', 'type', 'file_id', 'top', 'user_id', 'video', 'documents', 'content', 'lang', 'lang_hash', 'views', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['type', 'file_id', 'top', 'user_id', 'lang', 'status', 'views', 'published_at', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['published_at', 'created_at', 'updated_at'], 'required'],
            [['title', 'slug', 'description', 'video', 'documents', 'content'], 'string', 'max' => 255],
            [['lang_hash'], 'string', 'max' => 32],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'top' => Yii::t('app', 'Top'),
            'user_id' => Yii::t('app', 'User ID'),
            'video' => Yii::t('app', 'Video'),
            'documents' => Yii::t('app', 'Documents'),
            'content' => Yii::t('app', 'Content'),
            'lang' => Yii::t('app', 'Lang'),
            'lang_hash' => Yii::t('app', 'Lang Hash'),
            'status' => Yii::t('app', 'Status'),
            'views' => Yii::t('app', 'Views'),
            'published_at' => Yii::t('app', 'Published At'),
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PostQuery(get_called_class());
    }

}
