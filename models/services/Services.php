<?php

namespace app\models\services;

use Yii;
use app\models\user\User;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description_min
 * @property string|null $description_max
 * @property string|null $image
 * @property int|null $status
 * @property string|null $video_url
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Services extends \yii\db\ActiveRecord
{

    const ACTIVE = 1;

    const INACTIVE = 0;

    public $filePath = 'uploads/images/services/';

    public function behaviors()
    {
        return [
            'user' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description_min', 'description_max'], 'string'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image', 'video_url'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
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
            'name' => 'Nume',
            'description_min' => 'Descriere scurtă',
            'description_max' => 'Descriere lungă',
            'image' => 'Imagine',
            'video_url' => 'Video YouTube URL',
            'status' => 'Statut',
            'created_by' => 'Creat de',
            'updated_by' => 'Actualizat de',
            'created_at' => 'Creat la',
            'updated_at' => 'Actualizat la',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
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


    public static function findServices()
    {
        return Services::find()->where(['status' => Services::ACTIVE])->orderBy('updated_at desc');
    }
}
