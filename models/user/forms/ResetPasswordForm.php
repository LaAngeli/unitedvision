<?php

namespace app\models\user\forms;

use Yii;
use yii\base\Model;
use app\models\user\User;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use app\helpers\TranslateHelper;



// PASSWORD FORM RESET

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{

    public $password;
    public $confirm_password;

    private $_user;


    public function __construct($token, $email, $config = [])
    {

        if (empty($token) || !is_string($token) || empty($email) || !is_string($email)) {
            throw new \yii\web\NotFoundHttpException;
        }

        $this->_user = User::findUserByResetToken($token, $email);

        if (!$this->_user) {
            throw new \yii\web\NotFoundHttpException;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['password', 'confirm_password'], 'required'],
            [['confirm_password'], 'compare', 'compareAttribute' => 'password', 'message' => "Parolele nu coincid"],
            ['password', 'string', 'min' => 6, 'max' => 15],
        ];
    }

    public function attributeLabels()
    {

        $translate = new TranslateHelper;
        return [
            'password' => $translate->t([
                [
                    'lang' => 'en-US',
                    'value' => 'New Password*'
                ],
                [
                    'lang' => 'ro-RO',
                    'value' => 'Parolă nouă*'
                ]
            ]),
            'confirm_password' => $translate->t([
                [
                    'lang' => 'en-US',
                    'value' => 'Confirm Password*'
                ],
                [
                    'lang' => 'ro-RO',
                    'value' => 'Confirmă Parola*'
                ]
            ]),
        ];
    }


    public function resetPassword()
    {
        if ($this->validate()) {
            $sendMail = new User;
            $user = $this->_user;
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->updated_at = date('Y-m-d H-i-s', time());
            $user->reset_token = null;

            $sendMail->passwordResetNotifyEmail($user);
            return $user->save();
        }
        return false;
    }
}
