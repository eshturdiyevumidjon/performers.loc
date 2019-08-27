<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "about_company".
 *
 * @property int $id
 * @property string $logo Лого
 * @property string $name Наименование компании
 * @property string $phone Телефон
 * @property string $email Email
 * @property string $facebook Facebook
 * @property string $instagram Instagram
 * @property string $address Адрес
 * @property string $coordinate_x Coordinate X
 * @property string $coordinate_y Coordinate Y
 */
class AboutCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $logo_image;
    public $phone_numbers;

    public static function tableName()
    {
        return 'about_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'string'],
            [['logo_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg,svg',],
            [['phone_numbers'],'safe'],
            [['logo','telegram', 'name', 'phone', 'email', 'facebook', 'instagram', 'coordinate_x', 'coordinate_y'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logo' => 'Logo',
            'logo_image' => 'Logo',
            'name' => Yii::t('app','Name'),
            'phone_numbers' => Yii::t('app','Phone numbers'),
            'phone' => Yii::t('app','Phone'),
            'email' => Yii::t('app','Email address'),
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'telegram' => 'Telegram',
            'address' => 'Address',
            'coordinate_x' => 'Coordinate X',
            'coordinate_y' => 'Coordinate Y',
        ];
    }
    public function getImage(){
        
        $adminka = Yii::$app->params['adminka'];
        return $this->logo != null ? '<img style="width: 70px; height: 60px" src="'.$adminka.'uploads/' . $this->logo .'">' : '<img style="width: 70px; height: 60px" src="'.$adminka.'uploads/noimg.jpg">';
    }
}