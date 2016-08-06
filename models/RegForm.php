<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
                ['username', 'email', 'password'],
                'filter', 
                'filter' => 'trim',
            ],
            [
                ['username', 'password', 'email'],
                'required',
                'message' => 'Поле должно быть заполнено',
            ],
            [
                'username',
                'string',
                'min' => 2,
                'max' => 255,
                'message' => 'Имя должно содержать от 2 до 255 символов',
            ],
            [
                'password', 
                'string', 
                'min' => 6, 
                'max' => 255,
            ],
            [
                'email',
                'email',
                'message' => 'Неправильный email-адрес'
            ],
            [
                'username',
                'unique',
                'targetClass' => User::className(),
                'message' => 'Это имя занято',
            ],
            [
                'email',
                'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже зарегистрирована',
            ],
            [
                'status',
                'default',
                'value' => User::STATUS_ACTIVE,
                'on' => 'default',
            ],
            [
                'status',
                'in',
                'range' => [
                    User::STATUS_ACTIVE, 
                    User::STATUS_NOT_ACTIVE
                ]
            ],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'password' => 'Пароль',
            'email' => 'Почта',
        ];
    }
    public function reg()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email    = $this->email;
        $user->status   = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save()?$user:null;
    }
}