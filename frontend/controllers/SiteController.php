<?php
namespace frontend\controllers;

use common\models\Constants;
use common\models\EmailConfirm;
use common\models\extend\AdsExtend;
use common\models\extend\CarSerieExtend;
use common\models\extend\DocumentExtend;
use common\models\extend\RatingExtend;
use common\models\extend\UserExtend;
use common\models\search\AdsSearch;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\forms\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\forms\SignupForm;
use frontend\models\ContactForm;
use common\models\UserOauthKey;
use common\components\CommonFunctions;

/**
 * Site controller
 */
class SiteController extends BehaviorsController
{
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
     * @return mixed
     */
    public function actionIndex()
    {
        $ip = Yii::$app->request->getUserIP();

        $searchModel = new AdsSearch();
        $searchModel->status = Constants::STATUS_ACTIVE;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelPaid = new AdsSearch();
        $searchModelPaid->status = Constants::STATUS_ACTIVE;
        $searchModelPaid->end_paid = time();
        $dataProviderPaid = $searchModelPaid->searchPaid(Yii::$app->request->queryParams);
        //dd($dataProviderPaid->models);

        $marks = AdsExtend::find()
            ->select(['ads.id_car_mark', 'COUNT(id_car_mark) AS countmark'])
            ->where(['temp' => 0])
            ->groupBy(['id_car_mark'])
            ->orderBy(['countmark' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPaid' => $searchModelPaid,
            'dataProviderPaid' => $dataProviderPaid,
            'marks' => $marks
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionVklogin()
    {
        /** @var $eauth \nodge\eauth\ServiceBase */
        UserOauthKey::oaufProcess('vkontakte');         
    }
    
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
       $serviceName = Yii::$app->getRequest()->getQueryParam('service');
        if (isset($serviceName)) {
            UserOauthKey::oaufProcess($serviceName);
        }
        
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionSearch()
    {
        return $this->render('search');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionTop()
    {
        $searchModel = new AdsSearch();
        $searchModel->status = Constants::STATUS_ACTIVE;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelPaid = new AdsSearch();
        $searchModelPaid->status = Constants::STATUS_ACTIVE;
        $searchModelPaid->end_paid = time();
        $dataProviderPaid = $searchModelPaid->searchPaid(Yii::$app->request->queryParams);

        return $this->render('top', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelPaid' => $searchModelPaid,
            'dataProviderPaid' => $dataProviderPaid,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAds()
    {
        return $this->render('ads');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionInfo()
    {
        return $this->render('info');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionArticles()
    {
        $model = DocumentExtend::findOne(['type' => 'articles-page']);
        return $this->render('articles', ['model' => $model]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionQuestions()
    {
        return $this->render('questions');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $model = DocumentExtend::findOne(['type' => 'about-page']);
        return $this->render('about', ['model' => $model]);
    }

    /**
     * Регистрация
     * @return string|\yii\web\Response
     */
    public function actionSignup()
    {
        // Уже авторизированных отправляем на домашнюю страницу
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SignupForm();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-envelope',
                    'message'   => ' '.\Yii::t('app', 'Ссылка с подтверждением регистрации отправлена на Email.'),
                ]
            );
            return $this->redirect(['index']);
        }

        return $this->render('_signup-form', [
            'model' => $model,
        ]);
    }

    public function actionActivateAccount($token)
    {
        try {
            $model = new EmailConfirm($token);
        } catch (\HttpInvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user_id = $model->confirmEmail()) {
            // Авторизируемся при успешном подтверждении
            \Yii::$app->user->login(UserExtend::findIdentity($user_id));
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-ok',
                    'message'   => ' '.\Yii::t('app', 'Активация прошла успешно.'),
                ]
            );
        }

        return $this->redirect(['/profile']);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                \Yii::$app->session->set(
                    'message',
                    [
                        'type'      => 'success',
                        'icon'      => 'glyphicon glyphicon-envelope',
                        'message'   => ' '.\Yii::t('app', 'Проверьте вашу электронную почту и следуйте дальнейшим инструкциям.'),
                    ]
                );
                return $this->redirect(['index']);
            } else {
                \Yii::$app->session->set(
                    'message',
                    [
                        'type'      => 'danger',
                        'icon'      => 'glyphicon glyphicon-envelope',
                        'message'   => ' '.\Yii::t('app', 'К сожалению, мы не можем сбросить пароль для введенной электронной почты.'),
                    ]
                );
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-envelope',
                    'message'   => ' '.\Yii::t('app', 'Новый пароль сохранен.'),
                ]
            );
            return $this->redirect(['index']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionLikeSlick($id, $index)
    {
        $model = new RatingExtend();
        $model->ads_id = $id;
        $model->user_id = Yii::$app->user->id;
        if ($model->save()) {
            $model = AdsExtend::findOne($id);
            $model->rating = $model->rating + 1;
            if ($model->save()) {
                \Yii::$app->session->set(
                    'message',
                    [
                        'type'      => 'success',
                        'icon'      => 'glyphicon glyphicon-bell',
                        'message'   => ' '.\Yii::t('app', 'Вы успешно проголосовали.'),
                    ]
                );
            }
        }

        return $this->render('_item_slick', [
            'model' => $model,
            'key'   => $id,
            'index'   => $index,
        ]);
    }

    public function actionDislikeSlick($id, $index)
    {
        RatingExtend::deleteAll(['ads_id' => $id, 'user_id' => Yii::$app->user->id]);
        $model = AdsExtend::findOne($id);
        $model->rating = $model->rating - 1;
        if ($model->save()) {
            \Yii::$app->session->set(
                'message',
                [
                    'type'      => 'success',
                    'icon'      => 'glyphicon glyphicon-bell',
                    'message'   => ' '.\Yii::t('app', 'Вы успешно проголосовали.'),
                ]
            );
        }

        return $this->render('_item_slick', [
            'model' => $model,
            'key'   => $id,
            'index'   => $index,
        ]);
    }
}
