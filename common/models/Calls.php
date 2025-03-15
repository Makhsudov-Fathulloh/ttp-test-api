<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "calls".
 *
 * @property int $id
 * @property int|null $count
 * @property int|null $ball
 * @property int $created_at
 * @property int $updated_at
 */
class Calls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'ball'], 'default', 'value' => null],
            [['count', 'ball', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'count' => Yii::t('app', 'Count'),
            'ball' => Yii::t('app', 'Ball'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CallsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CallsQuery(get_called_class());
    }

}
