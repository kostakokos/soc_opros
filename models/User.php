<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;

class User extends \yii\db\ActiveRecord 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'email', 'sex_id', 'years_old'], 'required'],
            [['sex_id', 'years_old'], 'integer'],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 250],
            [['sex_id'], 'exist', 'skipOnError' => true, 
                'targetClass' => Sex::className(), 
                'targetAttribute' => ['sex_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSex()
    {
        return $this->hasOne(Sex::className(), ['id' => 'sex_id']);
    }
}
