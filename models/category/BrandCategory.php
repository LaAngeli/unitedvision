<?php

namespace app\models\category;

use Yii;
use app\models\category\Category;
use app\models\producer\Producer;

/**
 * This is the model class for table "brand_category".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $producer_id
 *
 * @property Category $category
 * @property Producer $producer
 */
class BrandCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brand_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'producer_id'], 'safe'],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['producer_id'], 'exist', 'targetClass' => Producer::class, 'targetAttribute' => ['producer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'producer_id' => 'Producer ID',
        ];
    }

    // /**
    //  * Gets query for [[Category]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getCategory()
    // {
    //     return $this->hasOne(Category::class, ['id' => 'category_id']);
    // }

    // /**
    //  * Gets query for [[Producer]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getProducer()
    // {
    //     return $this->hasMany(Producer::class, ['id' => 'producer_id']);
    // }

    public function saveBrandCategory($inputs, $options): void
    {
        $this->deleteCategoryBrand($options['producer_id']);
        if (!empty($inputs) and $inputs !== null) {
            foreach ($inputs as $input) {
                $category = Category::find()->where(['id' => $input])->one();
                if ($this->validate()) {
                    if (!empty($category) and $category !== null) {
                        $brandCategory = new BrandCategory();
                        $brandCategory->producer_id = $options['producer_id'];
                        $brandCategory->category_id = $input;
                        $brandCategory->save();
                    }
                }
            }
        }
    }

    private function deleteCategoryBrand($modelId): void
    {
        $categoryBrand = $this->find()->where(['producer_id' => $modelId])->all();

        foreach ($categoryBrand as $item) {
            $item->delete();
        }
    }
}
