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
            [['logo', 'name', 'phone', 'email', 'facebook', 'instagram', 'coordinate_x', 'coordinate_y'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'address' => 'Address',
            'coordinate_x' => 'Coordinate X',
            'coordinate_y' => 'Coordinate Y',
        ];
    }
}
