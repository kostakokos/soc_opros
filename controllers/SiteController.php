<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\StartForm;
use app\models\Sex;
use yii\helpers\ArrayHelper;
use app\models\Questions;
use app\models\QuestionUser;
use app\models\Answers;
use app\models\User;
use yii\data\ActiveDataProvider;
use app\models\SocialPoll;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }


    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        if (Yii::$app->request->url != '/site/poll') {
            if ($session->isActive) {
                if ($user_pull = $session->get('user_pull')) {
                    $session->setFlash('warning', 'Пройдите опрос до конца');
                    return $this->redirect(['poll']);
                }
            }
        }

        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionStart()
    {
        $model = new StartForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->createUser();
            if (is_object($user)) {

                $session = Yii::$app->session;
                if (!$session->isActive) {
                    $session->open();
                }
                $session->set('user_pull', $user->id);
                $session->set('socopros', $user->social_poll_id);

                return $this->redirect(['poll']);
            }
        }

        $sex = Sex::find()->all();
        $sex = ArrayHelper::map($sex, 'id', 'name');

        $socialPoll = SocialPoll::find()->all();
        $socialPoll = ArrayHelper::map($socialPoll, 'id', 'name');

        return $this->render('start', compact('model', 'sex', 'socialPoll'));
    }

    public function actionPoll()
    {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $model = new QuestionUser();
            if (Yii::$app->request->isPost) {
                if ($model->load(Yii::$app->request->post())) {
                    $model->save();
                }
                return $this->refresh();
            }

            if (($user_pull = $session->get('user_pull')) && ($socopros = $session->get('socopros'))) {
                $question_user = QuestionUser::find()
                    ->select(['questions_id'])->where(['user_id' => $user_pull]);
                $question = Questions::find()
                    ->where(['and', 
                        ['not in', 'id', $question_user],
                        ['social_poll_id' => $socopros],
                    ])->one();

                if (!is_object($question)) {
                    $session->destroy();
                    $session->close();
                    return $this->render('final');
                }

                $answers = Answers::find()->all();
                $answers = ArrayHelper::map($answers, 'id', 'name');
    
                return $this->render('poll',compact('model', 'question', 'answers', 'user_pull'));
            }    
        }
        return $this->redirect(['index']);
    }

    public function actionAllpoll() 
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);
        return $this->render('allpoll',compact('dataProvider'));
    }

    public function actionAnswers($user) 
    {
        $questionUser = QuestionUser::find()->where(['user_id' => $user]);
        $dataProvider = new ActiveDataProvider([
            'query' => $questionUser,
        ]);
        return $this->render('answers',compact('dataProvider'));
    }
}
