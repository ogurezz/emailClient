<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $status;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
                ['username', 'password'],
                'required',
                'on' => 'default',
                'message' => 'Поле должно быть заполнено',
            ],
            [
                'email',
                'email',
                'message' => 'Неправильный email-адрес',
            ],
            [
                'rememberMe', 
                'boolean',
            ],
            [
                'password',
                'validatePassword',
            ],
        ];
    }
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) :
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) :
                $this->addError($attribute, 'Неправильное имя пользователя или пароль');
            endif;
        endif;
    }
    public function getUser()
    {
        if ($this->_user === false):
            $this->_user = User::findByUsername($this->username);
        endif;
        return $this->_user;
    }
    public function login()
    {
        if ($this->validate()):
            $this->status = ($user = $this->getUser())?$user->status:User::STATUS_NOT_ACTIVE;
            if ($this->status === User::STATUS_ACTIVE):
                return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30: 0);
            else :
                return false;
            endif;
        endif;
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }
}