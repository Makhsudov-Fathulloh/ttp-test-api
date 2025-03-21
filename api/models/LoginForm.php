<?php

namespace api\models;

use common\models\User;
use common\models\UserToken;
use yii\base\Model;
use Yii;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            [['username', 'password'], 'validateLetter'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function validateLetter($attribute, $params)
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $this->$attribute)) {
            $this->addError($attribute, 'Faqat lotin harflari va raqamlar kiriting.');
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return false whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();

//            $user->token = Yii::$app->security->generateRandomString(32);
//            return $user->save() ? $user->token : null;

            $token = Yii::$app->security->generateRandomString(32);

            $userToken = new UserToken();
            $userToken->user_id = $user->id;
            $userToken->token = $token;
            $userToken->refresh_token = Yii::$app->security->generateRandomString(32);
            $userToken->expires_at = (new \DateTime())
                ->add(new \DateInterval('PT3600S'))
                ->format('Y-m-d H:i:s');
            $userToken->refresh_token_expires_at = (new \DateTime())
                ->add(new \DateInterval('PT259200S'))
                ->format('Y-m-d H:i:s');

            return $userToken->save() ? $userToken : null;
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
