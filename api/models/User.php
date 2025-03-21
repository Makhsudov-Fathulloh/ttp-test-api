<?php

namespace api\models;

class User extends \common\models\User
{
    public function fields()
    {
        $fields = parent::fields();

        unset($fields['token'], $fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);

        return [
            'id',
            'name' => function ($model) {
                return $model->first_name . ' ' . $model->last_name;
            },
            'username',
            'email',
            'role',
            'phone',
            'status',
            'created_at',
            'updated_at',
        ];
    }
}