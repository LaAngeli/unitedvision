<?php

namespace app\models\user\forms;

use Yii;
use yii\base\Model;
use app\models\user\User;



/**
 * RgisterForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends User
{
    public $firstname;

    public $lastname;

    public $email;

    public $email_repeat;

    public $role;




    /**
     * @return array the validation rules.
     */
    public function rules()
    {

        return [
            //required inputs
            [['firstname', 'lastname', 'email', 'email_repeat', 'role'], 'required'],

            // trim inputs
            [['firstname', 'lastname', 'email', 'email_repeat', 'role'], 'trim'],

            // costum validation
            [['role'], 'validateRole'],

            //inputs length
            [['firstname', 'lastname'], 'string', 'min' => 2, 'max' => 20],

            //email input type email validation
            [['email'], 'email'],

            //inputs compare
            [['email_repeat'], 'compare', 'compareAttribute' => 'email', 'message' => 'Email-urile nu coincid'],

            //email unique check
            [['email'], 'unique', 'targetClass' => User::class],


        ];
    }


    public function attributeLabels()
    {
        return [
            'firstname' => 'Prenume',
            'lastname' => 'Nume',
            'email' => 'Email',
            'email_repeat' => 'Repeta email',
            'role' => 'Rol'
        ];
    }

    public function validateRole($attribute)
    {
        if (!in_array($this->$attribute, ['admin', 'moderator', 'user'])) {
            $this->addError($attribute, 'Rolul ' . $this->role . ' nu există');
        }
    }


    public function beforeValidate()
    {
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        return parent::beforeValidate();
    }



    public function saveRecord()
    {
        if ($this->validate()) {
            $user = new User;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->email = $this->email;
            $user->email_token = $user->generateSecurityToken(255);
            $user->auth_key = $user->generateSecurityToken(255);
            $user->status = $user::USER_INACTIVE;
            // $user->created_at = $dateTime = date('Y-m-d H-i-s', time());
            // $user->updated_at = $dateTime;

            if ($user->save()) {


                if ($this->role !== 'user') {

                    $auth = Yii::$app->authManager;

                    $userRole = $auth->getRole($this->role);

                    $auth->assign($userRole, $user->getId());
                }

                $user->authConfirmationEmail($user);

                return $user;
            }
            return false;
        }
        return false;
    }
}
