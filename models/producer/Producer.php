<?php

namespace app\models\producer;

use app\models\category\BrandCategory;
use Yii;
use app\models\category\Category;
use app\models\user\User;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "producer".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description_min
 * @property string|null $description_max
 * @property string|null $image_logo
 * @property string|null $image_brand
 * @property string|null $image_slider_big
 * @property string|null $image_slider_small
 * @property string|null $image_video_preview
 * @property string|null $video_url
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Category[] $categories
 * @property User $createdBy
 * @property User $updatedBy
 */
class Producer extends \yii\db\ActiveRecord
{

    const ACTIVE = 1;

    const INACTIVE = 0;

    public $filePath = 'uploads/images/brands/';

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
        return 'producer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['description_min', 'description_max'], 'string'],
            // [['status', 'created_by', 'updated_by'], 'integer'],
            // [['created_at', 'updated_at'], 'safe'],
            // [['name', 'image_logo', 'image_brand', 'image_slider_big', 'image_slider_small', 'image_video_preview'], 'string', 'max' => 255],
            // [['video_url'], 'string', 'max' => 500],
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
            'name' => 'Nume brand',
            'description_min' => 'Descriere scurtă',
            'description_max' => 'Descriere lungă',
            'image_logo' => 'Imagine logo',
            'image_brand' => 'Imagine brand',
            'image_slider_big' => 'Imagine slider desktop',
            'image_slider_small' => 'Imagine slider mobil',
            'image_video_preview' => 'Imagine previzualizare video',
            'video_url' => 'Video URL Youtube',
            'status' => 'Statut',
            'created_by' => 'Creat de',
            'updated_by' => 'Actualizat de',
            'created_at' => 'Creat la',
            'updated_at' => 'Actualizat la',
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */


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

    public static function findProducer()
    {
        return Producer::find()->where(['status' => Producer::ACTIVE])->orderBy('updated_at desc');
    }


    public function brandSub($id)
    {

        $catBrand = BrandCategory::find()->select(['producer_id'])->where(['category_id' => $id]);
        return $catBrand;
    }

    public function brandIn($id)
    {
        return $this->find()
            ->where(['in', 'id', $this->brandSub($id)]);
    }

    public function brandNot($id)
    {
        return $this->find()
            ->where(['not in', 'id', $this->brandSub($id)])
            ->all();
    }
}
