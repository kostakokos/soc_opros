<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord 
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['phone', 'email', 'sex_id', 'years_old', 'social_poll_id'], 'required'],
            [['sex_id', 'years_old', 'social_poll_id'], 'integer'],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 250],
            [
                ['sex_id'], 'exist', 'skipOnError' => true, 
                'targetClass' => Sex::className(), 
                'targetAttribute' => ['sex_id' => 'id']
            ],
            [   
                ['social_poll_id'], 'exist', 'skipOnError' => true, 
                'targetClass' => SocialPoll::className(), 
                'targetAttribute' => ['social_poll_id' => 'id']
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Телефон',
            'email' => 'Почта',
            'sex_id' => 'Пол',
            'years_old' => 'Возраст Лет',
        ];
    }
   
    public function getPersonalDatas()
    {
        return $this->hasOne(PersonalData::className(), ['user_id' => 'id']);
    }

    public function getQuestionUsers()
    {
        return $this->hasMany(QuestionUser::className(), ['user_id' => 'id']);
    }

    public function getSex()
    {
        return $this->hasOne(Sex::className(), ['id' => 'sex_id']);
    }

    public function getSocialPoll()
    {
        return $this->hasOne(SocialPoll::className(), ['id' => 'social_poll_id']);
    }
}
