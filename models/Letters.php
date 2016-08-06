<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%letters}}".
 *
 * @property integer $id
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property integer $created_at
 * @property integer $updated_at
 */
class Letters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%letters}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'subject', 'body'], 'required'],
            [['body'], 'string'],
            [['created_at'], 'integer'],
            [['updated_at'], 'integer'],
            [['email', 'subject'], 'string', 'max' => 255],
        ];
    }
    public function behaviors()
    {
        return  [TimestampBehavior::className()];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Адрес получателя',
            'subject' => 'Тема',
            'body' => 'Текст',
            'created_at' => 'Дата отправки',
        ];
    }
}
