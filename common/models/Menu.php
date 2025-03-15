<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $alias
 * @property string|null $type
 * @property int|null $lang
 * @property string|null $lang_hash
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property MenuItem[] $menuItems
 */
class Menu extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'type', 'lang', 'lang_hash', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['lang', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['title', 'alias', 'type'], 'string', 'max' => 255],
            [['lang_hash'], 'string', 'max' => 32],
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
            'type' => Yii::t('app', 'Type'),
            'lang' => Yii::t('app', 'Lang'),
            'lang_hash' => Yii::t('app', 'Lang Hash'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[MenuItem]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MenuItemQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItem::class, ['menu_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MenuQuery(get_called_class());
    }

}
