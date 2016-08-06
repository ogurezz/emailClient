<?php

namespace app\controllers;


use Yii;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\User;
use app\models\MessageForm;
use app\models\Letters;
use app\models\Imap;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [ // Настройка прав доступа пользователей
                'class' => AccessControl::className(),
                'only' => [// AccessControl используеться только для данных actio
                    'login',
                    'reg',
                    'logout',
                    'getmail',
                    'delmail',
                    'message', 
                ],
                'rules' => [
                    [
                        'actions' => ['login', 'reg'], // Данное действие
                        'allow' => true, // Могут выполнять
                        'roles' => ['?'], // Только гости
                    ],
                    [
                        'actions' => [// Данное действие
                            'logout',
                            'getmail',
                            'delmail',
                            'message'
                        ], 
                        'allow' => true, // Могут выполнять
                        'roles' => ['@'], // Только авторизованные пользователи
                    ],
                    [
                        'actions' => ['index'], // Данное действие
                        'allow' => true, // Могут выполнять все, так как не задан параметр roles
                    ],                    
                ],
            ],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionReg()
    {
        $model = new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            if ($user = $model->reg()):
                if ($user->status === User::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)) :
                        return $this->goHome();
                    endif;
                endif;
            else:
                Yii::$app->session->setFlash('error', 'Ошибка при регистрации');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            endif;
        endif;
        return $this->render(
            'reg',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()): 
            return $this->goBack();
        endif;
        return $this->render(
            'login',
            [
                'model' => $model,
            ]
        );
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    /**
     * Displays message page.
     *
     * @return string
     */
    public function actionMessage()
    {
        $letter  = new Letters();
        $model   = new MessageForm();

        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            $letter->email   =  Html::encode($model->email);
            $letter->body    = Html::encode($model->body);
            $letter->subject = Html::encode($model->subject);
            if (!$letter->save()) {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения сообщения  в Базу Данных');
            } 
            Yii::$app->session->setFlash('success', 'Сообщение отправлено успешно <br>Сообщение внесено в Базу Данных успешно');
            return $this->refresh();
        } else {
            return $this->render('message', [
                'model' => $model,
            ]);
        }
    }
    public function actionGetmail()
    {
        $imap = new Imap();
        $numMsg = $imap->numMsg;
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount'      => $numMsg,
        ]);
        $start  = $numMsg - $pagination->offset;
        $finish = $start -  $pagination->limit;
        $finish = ($finish < 1)? 1: $finish;
        if (!$imap->receiveMessages($start, $finish)) {
            $imap->logout();
            Yii::$app->session->setFlash('error', "Ошибка получения почты");
            return $this->redirect(['/site/index']);
        }
        $imap->logout();
        // Yii::$app->session->setFlash('success', "Почта от $start до $finish  получена успешно  Всего $numMsg offset {$pagination->offset} limit {$pagination->limit}");
        return $this->render('getmail', [
            'letter'      => $imap,
            'active_page' => Yii::$app->request->get("page",1),
            'count_pages' => $pagination->pageCount,
            'pagination'  => $pagination,
        ]);
    }
    public function actionDelmail()
    {
        $id = Yii::$app->request->get('id');
        if (!$id) {
            return $this->redirect(['/site/index']);
        }
        $imap = new Imap();
        $imap->delMsg($id);
        Yii::$app->session->setFlash('success', "Сообщения удалены");
        $imap->logout();
        return $this->redirect(['/site/getmail']);
    }
}
