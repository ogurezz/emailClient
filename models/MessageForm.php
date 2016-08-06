<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

/**
 * MessageForm is the model behind the contact form.
 */
class MessageForm extends Model
{
    public $email;
    public $subject;
    public $body;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email, subject and body are required
            [['email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'email'    => 'Получатель',
            'subject' => 'Тема письма',
            'body'    => 'Текст письма'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return boolean whether the model passes validation
     */
    
 public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom([$email => Yii::$app->user->identity['username']])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
