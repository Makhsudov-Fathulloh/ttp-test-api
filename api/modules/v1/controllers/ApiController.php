<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;
use yii\rest\OptionsAction;

/**
 * Class ApiController
 *
 * @package common\components
 */
abstract class ApiController extends Controller
{
    /**
     * @var
     */
    public $data = 'data';

    public $serializer;

    public function init()
    {
        parent::init();
        $this->serializer = [
            'class' => 'yii\rest\Serializer',
            'collectionEnvelope' => $this->data,
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::class,
            ]
        ];
    }

}
