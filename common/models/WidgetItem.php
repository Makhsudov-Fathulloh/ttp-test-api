<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "widget_items".
 *
 * @property int $id
 * @property int $widget_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $secondary
 * @property int|null $file_id
 * @property int|null $sort
 * @property int|null $parent_id
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property File $file
 * @property WidgetItems $parent
 * @property Widgets $widgets
 * @property WidgetItems[] $widgetItems
 */
class WidgetItems extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'widget_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'secondary', 'file_id', 'sort', 'parent_id', 'deleted_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 9],
            [['widget_id', 'created_at', 'updated_at'], 'required'],
            [['widget_id', 'file_id', 'sort', 'parent_id', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title', 'description', 'secondary'], 'string', 'max' => 255],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::class, 'targetAttribute' => ['file_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => WidgetItems::class, 'targetAttribute' => ['parent_id' => 'id']],
            [['widget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Widgets::class, 'targetAttribute' => ['widget_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'widget_id' => Yii::t('app', 'Widget ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'secondary' => Yii::t('app', 'Secondary'),
            'file_id' => Yii::t('app', 'File ID'),
            'sort' => Yii::t('app', 'Sort'),
            'parent_id' => Yii::t('app', 'Parent ID'),
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
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WidgetItemsQuery
     */
    public function getParent()
    {
        return $this->hasOne(WidgetItems::class, ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Widget]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WidgetsQuery
     */
    public function getWidget()
    {
        return $this->hasOne(Widgets::class, ['id' => 'widget_id']);
    }

    /**
     * Gets query for [[WidgetItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WidgetItemsQuery
     */
    public function getWidgetItems()
    {
        return $this->hasMany(WidgetItems::class, ['parent_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\WidgetItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WidgetItemsQuery(get_called_class());
    }

}
