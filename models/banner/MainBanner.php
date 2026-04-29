<?php

namespace app\models\banner;

use Yii;
use yii\db\ActiveRecord;
use app\models\user\User;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "main_banner".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image_desktop
 * @property string|null $image_mobile
 * @property string|null $url
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class MainBanner extends ActiveRecord
{

    const ACTIVE = 1;

    const INACTIVE = 0;

    public $filePath = 'uploads/images/main_banner/';
    /**
     * {@inheritdoc}
     */


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
    public static function tableName()
    {
        return 'main_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['status', 'created_by', 'updated_by'], 'integer'],
            // [['created_at', 'updated_at'], 'safe'],
            // [['name', 'image_desktop', 'image_mobile'], 'string', 'max' => 255],
            // [['url'], 'string', 'max' => 500],
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
            'name' => 'Denumire',
            'image_desktop' => 'Imagine Desktop',
            'image_mobile' => 'Imagine Mobil',
            'url' => 'Link atașat',
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
}
