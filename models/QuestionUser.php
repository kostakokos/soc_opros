<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $questions_id
 * @property int $answers_id
 *
 * @property Questions $questions
 * @property User $user
 * @property Answers $answers
 */
class QuestionUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'questions_id', 'answers_id'], 'required'],
            [['user_id', 'questions_id', 'answers_id'], 'integer'],
            [   ['questions_id'], 'exist', 
                'skipOnError' => true, 
                'targetClass' => Questions::className(), 
                'targetAttribute' => ['questions_id' => 'id']],
            [   ['user_id'], 'exist', 'skipOnError' => true, 
                'targetClass' => User::className(), 
                'targetAttribute' => ['user_id' => 'id']],
            [   ['answers_id'], 'exist', 'skipOnError' => true, 
                'targetClass' => Answers::className(), 
                'targetAttribute' => ['answers_id' => 'id']],
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
            'questions_id' => 'Questions ID',
            'answers_id' => 'Вариант ответа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'questions_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasOne(Answers::className(), ['id' => 'answers_id']);
    }
}
