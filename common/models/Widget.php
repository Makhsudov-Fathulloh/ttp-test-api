<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "widgets".
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
 *
 * @property WidgetItems[] $widgetItems
 */
class Widgets extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widgets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'type', 'lang', 'lang_hash'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['lang', 'status', 'created_at', 'updated_at'], 'integer'],
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
        ];
    }

    /**
     * Gets query for [[WidgetItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WidgetItemsQuery
     */
    public function getWidgetItems()
    {
        return $this->hasMany(WidgetItems::class, ['widget_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\WidgetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WidgetsQuery(get_called_class());
    }

}
