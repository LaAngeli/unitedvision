<?php

namespace app\models\callback;

use Yii;
use app\models\user\User;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "callback".
 *
 * @property int $id
 * @property string|null $initials
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $updated_by
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $updatedBy
 */
class Callback extends ActiveRecord
{

    const ACTIVE = 1;

    const INACTIVE = 0;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'callback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_by'], 'integer'],
            [['created_at', 'updated_at', 'status'], 'safe'],
            [['initials', 'email', 'phone'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'initials' => 'Inițiale',
            'email' => 'Email',
            'phone' => 'Telefon',
            'notice' => 'Mesaj',
            'status' => 'Statut',
            'updated_by' => 'Actualizat de',
            'created_at' => 'Creat la',
            'updated_at' => 'Actualizat la',
        ];
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }


    public function callbackEmail($callback)
    {
        $confirmationLinkUrl = Yii::$app->urlManager->createAbsoluteUrl(['/admin/callback/view', 'id' => $callback->id, 'email' => $callback->email]);
        $body = Yii::$app->view->renderFile(Yii::getAlias('@app') . '/mail/layouts/callbackNotify.php', ['callback' => $callback, 'confirmLink' => $confirmationLinkUrl]);
        Yii::$app->mailer->compose()
            ->setFrom('ciobanu-23@inbox.ru')
            ->setTo('ciobanu-23@inbox.ru')
            ->setSubject('Solicitare de apel UNITEDVISION')
            ->setHtmlBody($body)
            ->send();
    }


    public function updateCallback()
    {
        $this->status = self::ACTIVE;
        $this->updated_by = Yii::$app->user->identity->id;
        $this->save();
    }
}
