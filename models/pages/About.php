<?php

namespace app\models\pages;

use Yii;
use app\models\user\User;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "about".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description_min
 * @property string|null $description_max
 * @property string|null $image
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class About extends \yii\db\ActiveRecord
{

    const ACTIVE = 1;

    const INACTIVE = 0;

    public $filePath = 'uploads/images/about/';

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
        return 'about';
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
            [['name', 'image'], 'string', 'max' => 255],
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
            'name' => 'Denumire',
            'description_min' => 'Descriere sucrtă',
            'description_max' => 'Descriere lungă',
            'image' => 'Imagine',
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

    public static function findAbout()
    {
        return About::find()->where(['status' => About::ACTIVE]);
    }
}
