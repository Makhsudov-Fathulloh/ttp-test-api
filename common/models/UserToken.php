<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_token".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $token
 * @property string|null $expires_at
 * @property string|null $refresh_token
 * @property string|null $refresh_token_expires_at
 *
 * @property User $user
 */
class UserToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'token', 'expires_at', 'refresh_token', 'refresh_token_expires_at'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['token', 'expires_at', 'refresh_token', 'refresh_token_expires_at'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'token' => Yii::t('app', 'Token'),
            'expires_at' => Yii::t('app', 'Expires At'),
            'refresh_token' => Yii::t('app', 'Refresh Token'),
            'refresh_token_expires_at' => Yii::t('app', 'Refresh Token Expires At'),
        ];
    }

    public function fields()
    {
        return [
            'token', 'expires_at', 'refresh_token', 'refresh_token_expires_at'
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

//    /**
//     * {@inheritdoc}
//     * @return \common\models\query\UserTokenQuery the active query used by this AR class.
//     */
//    public static function find()
//    {
//        return new \common\models\query\UserTokenQuery(get_called_class());
//    }

}
