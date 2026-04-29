<?php

namespace app\models\user\forms;



use app\helpers\TranslateHelper;
use Yii;
use yii\base\Model;
use app\models\user\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            [['email'], 'validateEmail'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        $translate = new TranslateHelper;
        return [
            'email' => $translate->t([
                [
                    'lang' => 'en-US',
                    'value' => 'Email *'
                ],
                [
                    'lang' => 'ro-RO',
                    'value' => 'Adresa email*'
                ]
            ]),

            'password' => $translate->t([
                [
                    'lang' => 'en-US',
                    'value' => 'Password *'
                ],
                [
                    'lang' => 'ro-RO',
                    'value' => 'Parola*'
                ]
            ]),

        ];
    }
    // Adresă de e-mail sau parolă nevalidă
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        $translate = new TranslateHelper;
        if (!$this->hasErrors()) {
            $user = $this->getUser();


            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, $translate->t([
                    [
                        'lang' => 'en-US',
                        'value' => 'Incorrect email or password'
                    ],
                    [
                        'lang' => 'ro-RO',
                        'value' => 'Adresă de e-mail sau parolă incorecte'
                    ]
                ]));
            }
        }
    }


    public function validateEmail($attribute, $params)
    {
        $translate = new TranslateHelper;
        if (!$this->hasErrors()) {
            $user = $this->getUser();


            if ($user and $user->status !== User::USER_ACTIVE) {
                return $this->addError($attribute, $translate->t([
                    [
                        'lang' => 'en-US',
                        'value' => 'Confirm email address'
                    ],
                    [
                        'lang' => 'ro-RO',
                        'value' => 'Confirmați adresa de e-mail'
                    ]
                ]));
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->auth_key = $user->generateSecurityToken(255);
            $user->save();
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    public function getStatus()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
