<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $type Тип
 * @property double $payed_sum Сколько оплатил клиент
 * @property int $status Статус
 * @property string $date_cr Дата создание заданий
 * @property string $date_close Дата закрытые заданий
 * @property int $position Состояние
 * @property int $user_id Исполнитель
 * @property string $shipping_address Адрес отгрузки
 * @property string $delivery_address Адрес доставки
 * @property string $shipping_coordinate_x Shipping Coordinate X
 * @property string $shipping_coordinate_y Shipping Coordinate Y
 * @property string $delivery_coordinate_x Delivery Coordinate X
 * @property string $delivery_coordinate_y Delivery Coordinate Y
 * @property string $date_begin Дата и время начала трансфера
 * @property double $offer_your_price Предложить свою цену
 * @property string $promo_code Промо-код
 * @property string $comment Комментария
 * @property int $adult_passengers Количество взрослых пассажиров
 * @property int $child_count Количество детей
 * @property int $category_id Категория транспорта
 * @property int $flight_number_status Номер авиа или ж/д рейса
 * @property string $flight_number Номер авиа или ж/д рейса
 * @property int $meeting_with_sign_status Встреча с табличкой
 * @property string $meeting_with_sign Встреча с табличкой
 * @property string $car_model Модель автомобиля
 * @property string $car_mark Марка автомобиля
 * @property string $image Фото
 * @property int $car_on_the_go Автомобиль на ходу
 * @property double $weight Вес
 * @property double $width Ширина
 * @property double $length Длина
 * @property double $height Высота
 * @property int $classification Классификация
 * @property int $loading_required_status Требуется погрузка/разгрузка
 * @property int $floor Этаж
 * @property int $lift Лифт
 * @property int $shipping_house_type Дом/квартира
 * @property int $shipping_house_floor Этаж
 * @property int $shipping_house_lift Лифт
 * @property double $shipping_house_area Площадь
 * @property int $delivery_house_type Дом/квартира
 * @property int $delivery_house_floor Этаж
 * @property int $delivery_house_lift Лифт
 * @property double $delivery_house_area Площадь
 * @property string $item_description Описание предметов
 * @property int $alert_email
 * @property int $view_performers
 *
 * @property Orders[] $orders
 * @property TransportCategory $category
 * @property User $user
 */
class Tasks extends \yii\db\ActiveRecord
{
    const SCENARIO_PASSENGERS = 'passengers';
    const SCENARIO_VEHICLES = 'vehicles';
    const SCENARIO_GOODS = 'goods';
    const SCENARIO_HELP = 'help';
    public $items;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'status', 'position', 'user_id', 'adult_passengers', 'child_count', 'category_id', 'flight_number_status', 'meeting_with_sign_status', 'car_on_the_go', 'loading_required_status', 'floor', 'lift', 'shipping_house_type', 'shipping_house_floor', 'shipping_house_lift', 'delivery_house_type', 'delivery_house_floor', 'delivery_house_lift', 'alert_email', 'view_performers'], 'integer'],
            [['payed_sum', 'offer_your_price', 'weight', 'width', 'length', 'height', 'shipping_house_area', 'delivery_house_area'], 'number'],
            [['date_cr', 'date_close', 'date_begin','items'], 'safe'],
            [['shipping_address', 'delivery_address','classification', 'comment', 'item_description'], 'string'],
            [['shipping_coordinate_x', 'shipping_coordinate_y', 'delivery_coordinate_x', 'delivery_coordinate_y', 'promo_code', 'flight_number', 'meeting_with_sign', 'car_model', 'car_mark', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransportCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [[/*'type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','adult_passengers','child_count','category_id','flight_number_status',*/'meeting_with_sign_status'],'required', 'on' => self::SCENARIO_PASSENGERS],
            [[/*'type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','car_model','car_mark','image',*/'car_on_the_go'],'required', 'on' => self::SCENARIO_VEHICLES],
            [[/*'type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','comment','weight','width','length','height','classification',*/'loading_required_status','floor','lift'],'required', 'on' => self::SCENARIO_GOODS],
            [[/*'type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','comment','shipping_house_type','shipping_house_floor','shipping_house_lift','shipping_house_area','delivery_house_type','delivery_house_floor','delivery_house_lift','delivery_house_area','item_description','alert_email',*/'view_performers'],'required', 'on' => self::SCENARIO_HELP]

        ];
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_cr']
                ],
            ],
        ];
    }
     public function scenarios()
    {

        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_PASSENGERS] = ['type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','comment','adult_passengers','child_count','category_id','flight_number_status','flight_number','meeting_with_sign_status','alert_email','meeting_with_sign'];

        $scenarios[self::SCENARIO_VEHICLES] = ['type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','comment','car_model','car_mark','image','alert_email','car_on_the_go'];

        $scenarios[self::SCENARIO_GOODS] = ['type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','comment','weight','width','length','height','classification','loading_required_status','floor','alert_email','lift'];

        $scenarios[self::SCENARIO_HELP] = ['type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','comment','shipping_house_type','shipping_house_floor','shipping_house_lift','shipping_house_area','delivery_house_type','delivery_house_floor','delivery_house_lift','delivery_house_area','item_description','alert_email','view_performers'];

        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => Yii::t('app','Type'),
            'payed_sum' => Yii::t('app','Payed Sum'),
            'status' => Yii::t('app','Status'),
            'date_cr' => Yii::t('app','Date Create'),
            'date_close' => Yii::t('app','Date Close'),
            'position' => Yii::t('app','Position'),
            'user_id' => Yii::t('app','Client'),
            'shipping_address' => Yii::t('app','Shipping Address'),
            'delivery_address' => Yii::t('app','Delivery Address'),
            'shipping_coordinate_x' => 'Shipping Coordinate X',
            'shipping_coordinate_y' => 'Shipping Coordinate Y',
            'delivery_coordinate_x' => 'Delivery Coordinate X',
            'delivery_coordinate_y' => 'Delivery Coordinate Y',
            'date_begin' => Yii::t('app','Date Begin'),
            'offer_your_price' => Yii::t('app','Price'),
            'promo_code' => Yii::t('app','Promo Code'),
            'comment' => Yii::t('app','Comment'),
            'adult_passengers' => Yii::t('app','Adult passengers Count'),
            'child_count' => Yii::t('app','Child Count'),
            'category_id' => Yii::t('app','Category of transport'),
            'flight_number_status' => Yii::t('app','Air or railway flight number'),
            'flight_number' => Yii::t('app','Air or railway flight number'),
            'meeting_with_sign_status' => Yii::t('app','Meeting With Sign'),
            'meeting_with_sign' => Yii::t('app','Meeting With Sign'),
            'car_model' => Yii::t('app','Car model'),
            'car_mark' => Yii::t('app','Car mark'),
            'image' => 'Image',
            'car_on_the_go' => Yii::t('app','Car On The Go'),
            'weight' => Yii::t('app','Weight'),
            'width' => Yii::t('app','Width'),
            'length' => Yii::t('app','Length'),
            'height' => Yii::t('app','Height'),
            'classification' => Yii::t('app','Classification'),
            'items' => Yii::t('app','Classification'),
            'loading_required_status' => Yii::t('app','Required load'),
            'floor' => Yii::t('app','Floor'),
            'lift' => Yii::t('app','Lift'),
            'shipping_house_type' => Yii::t('app','Type'),
            'shipping_house_floor' => Yii::t('app','Floor'),
            'shipping_house_lift' => Yii::t('app','Lift'),
            'shipping_house_area' => Yii::t('app','Area'),
            'delivery_house_type' => Yii::t('app','Type'),
            'delivery_house_floor' => Yii::t('app','Floor'),
            'delivery_house_lift' => Yii::t('app','Lift'),
            'delivery_house_area' => Yii::t('app','Area'),
            'item_description' => Yii::t('app','Description items'),
            'alert_email' => Yii::t('app','Alert Email'),
            'view_performers' => Yii::t('app','Only performers'),
        ];
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->user_id = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($insert);
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->date_cr=( $this->date_cr)?Yii::$app->formatter->asDate($this->date_cr, 'php:d.m.Y H:i'):""; 
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TransportCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getType()
    {
        return [
            '1' => 'Пассажирские перевозки',
            '2' => 'Перевозка автомобилей и техники',
            '3' => 'Грузовые перевозки',
            '4' => 'Помощь в переезде',
        ];
    }
    
}
