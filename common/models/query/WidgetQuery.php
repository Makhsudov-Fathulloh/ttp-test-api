<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Widget]].
 *
 * @see \common\models\Widget
 */
class WidgetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Widget[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Widget|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
