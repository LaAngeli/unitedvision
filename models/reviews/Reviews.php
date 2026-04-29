<?php

namespace app\models\reviews;

use Yii;
use app\models\user\User;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string|null $initials
 * @property string|null $image
 * @property string|null $review
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Reviews extends \yii\db\ActiveRecord
{

    const ACTIVE = 1;

    const INACTIVE = 0;

    public $filePath = 'uploads/images/reviews/';


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
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['review'], 'string'],
            // [['status', 'created_by', 'updated_by'], 'integer'],
            // [['created_at', 'updated_at'], 'safe'],
            // [['initials', 'image'], 'string', 'max' => 255],
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
            'initials' => 'Denumire partener/client',
            'review' => 'Recenzie',
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


    public static function findReviews()
    {
        return Reviews::find()->where(['status' => Reviews::ACTIVE])->orderBy('updated_at desc');
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
}
