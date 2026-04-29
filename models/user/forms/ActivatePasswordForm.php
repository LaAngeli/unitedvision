<?php

namespace app\models\user\forms;

use Yii;
use yii\base\Model;
use app\models\user\User;

/**
 *
 */
class ActivatePasswordForm extends Model
{

  public $password;
  public $password_repeat;



  // Functia pentru validare RegisterForm
  // Function for RegisterForm Validation
  public function rules()
  {
    return [
      [['password', 'password_repeat'], 'required'],

      [['password', 'password_repeat'], 'trim'],

      [['password'], 'string', 'min' => 8, 'max' => 16],

      // [['password'], 'validateStrongPassword'],

      [['password_repeat'], 'compare', 'compareAttribute' => 'password', 'message' => "Parolele nu coincid"],

    ];
  }

  public function activateProfile($model)
  {
    $user = $model;
    $user->password = Yii::$app->security->generatePasswordHash($this->password);
    $user->email_token = null;
    $user->status = User::USER_ACTIVE;
    $user->updated_at = $dateTime = date('Y-m-d H-i-s', time());
    return $user->save();
  }


  public function attributeLabels()
  {
    return [
      'password' => "Parola",
      'password_repeat' => "Repetă Parola"
    ];
  }

  // public function validateStrongPassword($attribute)
  // {
  //   $value = $this->password;

  //   // Define the pattern to match special characters
  //   $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';

  //   // Check if the password contains at least one special character
  //   if (!preg_match($pattern, $value)) {
  //     $this->addError($attribute, 'Parola trebuie să conțină cel puțin 8 caratere, un caracter special');
  //   }
  // }
}
