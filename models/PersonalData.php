<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_data".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $famaly
 * @property string $patronymic
 *
 * @property User $user
 */
class PersonalData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'famaly', 'patronymic'], 'string', 'max' => 60],
            [
                ['user_id'], 'exist', 
                'skipOnError' => true, 
                'targetClass' => User::className(), 
                'targetAttribute' => ['user_id' => 'id']
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
            'user_id' => 'User ID',
            'name' => 'Name',
            'famaly' => 'Famaly',
            'patronymic' => 'Patronymic',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
