<?php

namespace app\models\category;

use Yii;
use app\models\producer\Producer;
use app\models\category\BrandCategory;
use app\models\user\User;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description_min
 * @property string|null $description_max
 * @property string|null $image
 * @property int|null $status
 * @property int|null $producer_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $createdBy
 * @property Producer $producer
 * @property User $updatedBy
 */
class Category extends \yii\db\ActiveRecord
{

    const ACTIVE = 1;

    const INACTIVE = 0;

    public $filePath = 'uploads/images/category/';
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
        return 'category';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description_min', 'description_max'], 'string'],
            [['status', 'producer_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['producer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Producer::class, 'targetAttribute' => ['producer_id' => 'id']],
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
            'description_min' => 'Descriere scurtă',
            'description_max' => 'Descirere lungă',
            'image' => 'Imagine',
            'status' => 'Statut',
            'producer_id' => 'Producer ID',
            'created_by' => 'Creat de:',
            'updated_by' => 'Actualizate de:',
            'created_at' => 'Creat la:',
            'updated_at' => 'Actualizat la:',
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
     * Gets query for [[Producer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducer()
    {
        return $this->hasOne(Producer::class, ['id' => 'producer_id']);
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
        return Category::find()->where(['status' => Category::ACTIVE])->orderBy('updated_at desc');
    }


    public function brandSub($id)
    {

        $catBrand = BrandCategory::find()->select(['category_id'])->where(['producer_id' => $id]);
        return $catBrand;
    }

    public function brandIn($id)
    {
        return $this->find()
            ->where(['in', 'id', $this->brandSub($id)])
            ->all();
    }

    public function brandNot($id)
    {
        return $this->find()
            ->where(['not in', 'id', $this->brandSub($id)])
            ->all();
    }

    public function findCategoryOne($category_id)
    {
        return $this->find()->where(['status' => Category::ACTIVE, 'id' => $category_id])->one();
    }
}
