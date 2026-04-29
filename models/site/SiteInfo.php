<?php

namespace app\models\site;

use Yii;
use yii\db\ActiveRecord;
use app\models\user\User;

/**
 * This is the model class for table "site_info".
 *
 * @property int $id
 * @property string|null $site_name
 * @property string|null $logo_header
 * @property string|null $logo_footer
 * @property string|null $footer_text
 * @property string|null $site_image
 * @property string|null $phone_number
 * @property string|null $address
 * @property string|null $map_location
 * @property string|null $email
 * @property string|null $min_description
 * @property string|null $max_description
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property User $updatedBy
 */
class SiteInfo extends ActiveRecord
{

    public $filePath = 'uploads/images/site_info/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_info';
    }

    /**
     * {@inheritdoc}
     */
    // public function rules()
    // {
    //     return [
    //         [['map_location', 'max_description'], 'string'],
    //         [['updated_by'], 'integer'],
    //         [['updated_at'], 'safe'],
    //         [['site_name', 'logo_header', 'logo_footer', 'footer_text', 'site_image', 'phone_number', 'address', 'email', 'min_description'], 'string', 'max' => 255],
    //         [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '#ID',
            'site_name' => 'Denumire site',
            'min_description' => 'Descriere scurtă',
            'max_description' => 'Descriere lungă',
            'logo_header' => 'Logo din antetul site-ului',
            'logo_footer' => 'Logo din subsolul site-ului',
            'site_image' => 'Imagine site',
            'footer_text' => 'Text din subsolul site-ului',
            'phone_number' => 'Telefon',
            'address' => 'Adresă',
            'map_location' => 'Locație google maps',
            'email' => 'Email',
            'updated_at' => 'Actualizat la',
            'updated_by' => 'Actualizat de',
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
}
