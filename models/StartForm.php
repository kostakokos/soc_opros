<?php
namespace app\models;

use Yii;
use yii\base\Model;

class StartForm extends Model
{
    public $phone;
    public $email;
    public $sex;
    public $old;
    public $name;
    public $famaly;
    public $patronymic;

    public function rules()
    {
        return [
            [['phone', 'email', 'sex', 'old'], 'required'],
            ['email', 'email'],
            [['sex', 'old'], 'integer'],
            [['name', 'famaly', 'patronymic'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 60, 'min'=>5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Телефон',
            'email' => 'Почта',
            'sex' => 'Пол',
            'old' => 'Возраст',
            'name' => 'Имя',
            'famaly' => 'Фамилия',
            'patronymic' => 'Отчество',
        ];
    }

    public function writeUser()
    {
        $user = new User();
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->sex_id = $this->sex;
        $user->years_old = $this->old;
        if ($user->save()) {
            if (!empty($this->name) || !empty($this->famaly) || !empty($this->patronymic)) {
                $personalData = new PersonalData();
                $personalData->user_id = $user->id;
                $personalData->name = $this->name;
                $personalData->famaly = $this->famaly;
                $personalData->patronymic = $this->patronymic;
                $personalData->save();
            }
            $session = Yii::$app->session;
            if (!$session->isActive) {
                $session->open();
            }
            $session->set('user_pull', $user->id);
            
            return true;
        }
        return false;
    }

}