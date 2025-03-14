<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\WidgetItems]].
 *
 * @see \common\models\WidgetItems
 */
class WidgetItemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\WidgetItems[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\WidgetItems|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
