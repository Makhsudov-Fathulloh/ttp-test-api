<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu_items".
 *
 * @property int $id
 * @property int $menu_id
 * @property string $title
 * @property string|null $url
 * @property int|null $file_id
 * @property int|null $sort
 * @property int|null $menu_id_parent_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File $file
 * @property Menus $menu
 * @property MenuItems $menuIdParent
 * @property MenuItems[] $menuItems
 */
class MenuItems extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'sort', 'menu_id_parent_id', 'deleted_at'], 'default', 'value' => null],
            [['url'], 'default', 'value' => '#'],
            [['status'], 'default', 'value' => 9],
            [['menu_id', 'title', 'created_at', 'updated_at'], 'required'],
            [['menu_id', 'file_id', 'sort', 'menu_id_parent_id', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menus::class, 'targetAttribute' => ['menu_id' => 'id']],
            [['menu_id_parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => MenuItems::class, 'targetAttribute' => ['menu_id_parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menu_id' => Yii::t('app', 'Menu ID'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'file_id' => Yii::t('app', 'File ID'),
            'sort' => Yii::t('app', 'Sort'),
            'menu_id_parent_id' => Yii::t('app', 'Menu Id Parent ID'),
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
     * Gets query for [[Menu]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenusQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menus::class, ['id' => 'menu_id']);
    }

    /**
     * Gets query for [[MenuIdParent]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenuItemsQuery
     */
    public function getMenuIdParent()
    {
        return $this->hasOne(MenuItems::class, ['id' => 'menu_id_parent_id']);
    }

    /**
     * Gets query for [[MenuItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenuItemsQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItems::class, ['menu_id_parent_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MenuItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MenuItemsQuery(get_called_class());
    }

}
