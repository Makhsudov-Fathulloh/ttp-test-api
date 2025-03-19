<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $file
 * @property string|null $ext
 * @property string|null $folder
 * @property string|null $domain
 * @property int|null $user_id
 * @property string|null $path
 * @property int|null $size
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $downloads
 *
 * @property Banner[] $banners
 * @property History[] $histories
 * @property MenuItem[] $menuItems
 * @property Post[] $posts
 * @property Setting[] $settings
 * @property Station[] $stations
 * @property User $user
 * @property WidgetItem[] $widgetItems
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

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'file', 'ext', 'folder', 'domain', 'user_id', 'path', 'size', 'downloads'], 'default', 'value' => null],
            [['user_id', 'size', 'created_at', 'updated_at', 'downloads'], 'integer'],
            [['title', 'description', 'file','folder', 'domain', 'path'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 16],
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
            'description' => Yii::t('app', 'Description'),
            'file' => Yii::t('app', 'File'),
            'ext' => Yii::t('app', 'Ext'),
            'folder' => Yii::t('app', 'Folder'),
            'domain' => Yii::t('app', 'Domain'),
            'user_id' => Yii::t('app', 'User ID'),
            'path' => Yii::t('app', 'Path'),
            'size' => Yii::t('app', 'Size'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'downloads' => Yii::t('app', 'Downloads'),
        ];
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
     * Gets query for [[Banners]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BannerQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::class, ['file_id' => 'id']);
    }

    /**
     * Gets query for [[Histories]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\HistoryQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::class, ['file_id' => 'id']);
    }

    /**
     * Gets query for [[MenuItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenuItemQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItem::class, ['file_id' => 'id']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PostQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['file_id' => 'id']);
    }

    /**
     * Gets query for [[Settings]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SettingQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Setting::class, ['file_id' => 'id']);
    }

    /**
     * Gets query for [[Stations]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\StationQuery
     */
    public function getStations()
    {
        return $this->hasMany(Station::class, ['file_id' => 'id']);
    }

    /**
     * Gets query for [[WidgetItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WidgetItemQuery
     */
    public function getWidgetItems()
    {
        return $this->hasMany(WidgetItem::class, ['file_id' => 'id']);
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
