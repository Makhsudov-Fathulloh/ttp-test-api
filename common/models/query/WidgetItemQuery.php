<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\WidgetItem]].
 *
 * @see \common\models\WidgetItem
 */
class WidgetItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\WidgetItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\WidgetItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
