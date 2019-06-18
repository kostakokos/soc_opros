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
    public $socopros;

    public function rules()
    {
        return [
            [['phone', 'email', 'sex', 'old', 'socopros'], 'required'],
            ['email', 'email'],
            [['sex', 'old', 'socopros'], 'integer'],
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
            'socopros' => 'Соц. опрос',
        ];
    }

    public function createUser()
    {
        $user = new User();
        $user->social_poll_id = $this->socopros;
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
            return $user;
        }
        return false;
    }

}