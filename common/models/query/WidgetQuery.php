<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Widgets]].
 *
 * @see \common\models\Widgets
 */
class WidgetsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Widgets[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Widgets|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
