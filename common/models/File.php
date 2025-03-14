<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $file
 * @property string|null $ext
 * @property string|null $slug
 * @property string|null $folder
 * @property string|null $domain
 * @property int|null $user_id
 * @property int|null $folder_id
 * @property string|null $path
 * @property int|null $size
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $downloads
 *
 * @property Folders $folder0
 * @property MenuItems[] $menuItems
 */
class File extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'file', 'ext', 'slug', 'folder', 'domain', 'user_id', 'folder_id', 'path', 'size', 'downloads'], 'default', 'value' => null],
            [['user_id', 'folder_id', 'size', 'created_at', 'updated_at', 'downloads'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['title', 'description', 'file', 'slug', 'folder', 'domain', 'path'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 16],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folders::class, 'targetAttribute' => ['folder_id' => 'id']],
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
            'description' => Yii::t('app', 'Description'),
            'file' => Yii::t('app', 'File'),
            'ext' => Yii::t('app', 'Ext'),
            'slug' => Yii::t('app', 'Slug'),
            'folder' => Yii::t('app', 'Folder'),
            'domain' => Yii::t('app', 'Domain'),
            'user_id' => Yii::t('app', 'User ID'),
            'folder_id' => Yii::t('app', 'Folder ID'),
            'path' => Yii::t('app', 'Path'),
            'size' => Yii::t('app', 'Size'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'downloads' => Yii::t('app', 'Downloads'),
        ];
    }

    /**
     * Gets query for [[Folder0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoldersQuery
     */
    public function getFolder0()
    {
        return $this->hasOne(Folders::class, ['id' => 'folder_id']);
    }

    /**
     * Gets query for [[MenuItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenuItemsQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItems::class, ['file_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FileQuery(get_called_class());
    }

}
