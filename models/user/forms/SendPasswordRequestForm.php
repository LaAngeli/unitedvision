<?php

namespace app\models\User\Forms;

use app\helpers\TranslateHelper;
use Yii;
use app\models\user\User;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;


// PASSWORD RESET REQUEST FORM
class SendPasswordRequestForm extends Model
{

    public $email;


    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $translate = new TranslateHelper;
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email', 'exist',
                'targetClass' => '\app\models\user\User',
                'filter' => ['status' => User::USER_ACTIVE],
                'message' => $translate->t([
                    [
                        'lang' => 'en-US',
                        'value' => 'There is no active user with this email.'
                    ],
                    [
                        'lang' => 'ro-RO',
                        'value' => 'Nu există nici un utilizator activ cu asemenea email.'
                    ]
                ])
            ],
        ];
    }

    public function attributeLabels()
    {
        $translate = new TranslateHelper;
        return [
            'email' => $translate->t([
                [
                    'lang' => 'en-US',
                    'value' => 'Your email address*'
                ],
                [
                    'lang' => 'ro-RO',
                    'value' => 'Adresa de email*'
                ]
            ])
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {

        if ($this->validate()) {
            $user = new User();


            $userReset = $user->findUserPasswordReset($this);

            if (!$userReset) {
                return false;
            } else {
                $userReset->reset_token = $user->generateSecurityToken(255);
                $userReset->save();
            }


            return $user->resetPasswordEmail($userReset);
        }
        return false;
    }
}
