<?php

namespace app\controllers;

use app\models\user\forms\ActivatePasswordForm;
use app\models\user\forms\ResetPasswordForm;
use app\models\user\forms\SendPasswordRequestForm;
use app\models\user\User;
use Yii;
use yii\base\InvalidParamException;

use yii\web\BadRequestHttpException;
use yii\web\Controller;


use app\models\user\forms\LoginForm;



class AuthController extends Controller
{
    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::class,
    //             'only' => ['logout'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::class,
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionConfirmEmail()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/');
        }

        $passwordForm = new ActivatePasswordForm();

        $user = new User();


        if (Yii::$app->request->get()) {
            $id = htmlspecialchars(Yii::$app->request->get('id'));
            $email = htmlspecialchars(Yii::$app->request->get('email'));
            $email_token = htmlspecialchars(Yii::$app->request->get('email_token'));
        }

        $model = $user->findUserConfirm($id, $email, $email_token);


        if (!empty($model) and $model != null) {
            if ($passwordForm->load(Yii::$app->request->post()) and $passwordForm->activateProfile($model)) {

                // $user->accountActiveNotifyEmail($model);
                Yii::$app->session->setFlash('profileActivated', "Profil activat cu success");
                return $this->redirect('/auth/login');
            }

            return $this->render('activate-password', [
                'passwordForm' => $passwordForm,
            ]);
        } else {
            return $this->redirect('/');
        }
    }

    public function actionSendPasswordReset()
    {

        $model = new SendPasswordRequestForm();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->sendEmail();
                Yii::$app->session->setFlash('resetSend', "Scrisoare de resetare a parolei a fost trimisă pe adresa de email indicată");
                return $this->redirect('/auth/login');
            }
        }

        return $this->render('password-forgot', ['model' => $model]);
    }


    public function actionResetPassword($token, $email)
    {

        try {
            $model = new ResetPasswordForm($token, $email);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->resetPassword();
                Yii::$app->session->setFlash('passwordReset', "Parola a fost resetată cu success");
                return $this->redirect('/auth/login');
            }
        }

        return $this->render('password-reset', ['model' => $model]);
    }
}
