<?php

namespace app\models\user;

use Yii;
use app\models\callback\Callback;
use app\models\producer\Producer;
use app\models\category\Category;
use app\models\pages\About;
use app\models\services\Services;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $password
 * @property string|null $email
 * @property string|null $email_token
 * @property string|null $reset_token
 * @property string|null $auth_key
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property About[] $abouts
 * @property About[] $abouts0
 * @property Callback[] $callbacks
 * @property Category[] $categories
 * @property Category[] $categories0
 * @property Producer[] $producers
 * @property Producer[] $producers0
 * @property Services[] $services
 * @property Services[] $services0
 */
class User extends ActiveRecord implements IdentityInterface
{

    const USER_INACTIVE = 0;

    const USER_ACTIVE = 1;

    const USER_BAN = 2;
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['firstname', 'lastname', 'password', 'email', 'email_token', 'reset_token', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '#ID',
            'firstname' => 'Prenume',
            'lastname' => 'Nume',
            'password' => 'Password',
            'email' => 'Email',
            'email_token' => 'Email Token',
            'reset_token' => 'Reset Token',
            'auth_key' => 'Auth Key',
            'status' => 'Statut',
            'created_at' => 'Creat',
            'updated_at' => 'Actualizat',
        ];
    }

    /**
     * Gets query for [[Abouts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAbouts()
    {
        return $this->hasMany(About::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Abouts0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAbouts0()
    {
        return $this->hasMany(About::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Callbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCallbacks()
    {
        return $this->hasMany(Callback::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Categories0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories0()
    {
        return $this->hasMany(Category::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Producers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducers()
    {
        return $this->hasMany(Producer::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Producers0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducers0()
    {
        return $this->hasMany(Producer::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Services0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices0()
    {
        return $this->hasMany(Services::class, ['updated_by' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // return static::findOne(['access_token' => $token]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function getUserRole()
    {
        $role = Yii::$app->authManager->getRolesByUser($this->getId());
        foreach ($role as $item) {
            return $item->name;
        }
    }

    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    public function generatePasswordHash($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }


    public function generateSecurityToken($lenght = 255)
    {
        return Yii::$app->security->generateRandomString($lenght);
    }

    public function getUserIp()
    {
        if (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return false;
        }
    }

    public function findUserConfirm($id, $email, $email_token)
    {
        return $this->find()->where(['id' => $id, 'email' => $email, 'email_token' => $email_token])->one();
    }


    public function findUserPasswordReset($model)
    {

        return $this->find()
            ->where(['email' => $model->email, 'status' => self::USER_ACTIVE])
            ->one();
    }


    public function authConfirmationEmail($user)
    {
        $confirmationLinkUrl = Yii::$app->urlManager->createAbsoluteUrl(['/auth/confirm-email', 'id' => $user->id, 'email' => $user->email, 'email_token' => $user->email_token]);
        $body = Yii::$app->view->renderFile(Yii::getAlias('@app') . '/mail/layouts/registrationComplete.php', ['user' => $user, 'confirmLink' => $confirmationLinkUrl]);
        Yii::$app->mailer->compose()
            ->setFrom('ciobanu-23@inbox.ru')
            ->setTo($user->email)
            ->setSubject('Confirmare Înregistrare')
            ->setHtmlBody($body)
            ->send();
    }


    public function resetPasswordEmail($user)
    {

        $resetUrl = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset-password', 'email' => $user->email,  'token' => $user->reset_token]);

        $body = Yii::$app->view->renderFile(Yii::getAlias('@app') . '/mail/layouts/resetPassword.php', ['user' => $user, 'resetUrl' => $resetUrl]);
        Yii::$app->mailer->compose()
            ->setFrom('ciobanu-23@inbox.ru')
            ->setTo($user->email)
            ->setSubject('Resetarea Parolei')
            ->setHtmlBody($body)
            ->send();
    }

    public function accountActiveNotifyEmail($user)
    {
        $body = Yii::$app->view->renderFile(Yii::getAlias('@app') . '/mail/layouts/accountActivate.php', ['user' => $user]);
        Yii::$app->mailer->compose()
            ->setFrom('ciobanu-23@inbox.ru')
            ->setTo($user->email)
            ->setSubject('Profil Activat')
            ->setHtmlBody($body)
            ->send();
    }


    public function passwordResetNotifyEmail($user)
    {
        $body = Yii::$app->view->renderFile(Yii::getAlias('@app') . '/mail/layouts/resetNotify.php', ['user' => $user]);
        Yii::$app->mailer->compose()
            ->setFrom('ciobanu-23@inbox.ru')
            ->setTo($user->email)
            ->setSubject('Parola resetată cu succes')
            ->setHtmlBody($body)
            ->send();
    }

    public static function findUserByResetToken($token, $email)
    {
        return User::find()->where(['reset_token' => $token, 'email' => $email])->one();
    }
}
