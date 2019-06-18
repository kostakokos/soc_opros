<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property string $description
 *
 * @property QuestionUser[] $questionUsers
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'social_poll_id'], 'required'],
            [['description'], 'string'],
            [['social_poll_id'], 'integer'],
            [   
                ['social_poll_id'], 'exist', 'skipOnError' => true, 
                'targetClass' => SocialPoll::className(), 
                'targetAttribute' => ['social_poll_id' => 'id']
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
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionUsers()
    {
        return $this->hasMany(QuestionUser::className(), ['questions_id' => 'id']);
    }

    public function getSocialPoll()
    {
        return $this->hasOne(SocialPoll::className(), ['id' => 'social_poll_id']);
    }
}
