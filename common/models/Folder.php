<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "folders".
 *
 * @property int $id
 * @property string $title
 * @property string|null $alias
 * @property int|null $parent_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File[] $files
 * @property Folders[] $folders
 * @property Folders $parent
 */
class Folders extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'parent_id', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['title', 'created_at', 'updated_at'], 'required'],
            [['parent_id', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folders::class, 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FileQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::class, ['folder_id' => 'id']);
    }

    /**
     * Gets query for [[Folders]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoldersQuery
     */
    public function getFolders()
    {
        return $this->hasMany(Folders::class, ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoldersQuery
     */
    public function getParent()
    {
        return $this->hasOne(Folders::class, ['id' => 'parent_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FoldersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FoldersQuery(get_called_class());
    }

}
