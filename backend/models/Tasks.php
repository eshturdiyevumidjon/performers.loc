<?php

namespace backend\models;

use Yii;
use common\models\User;
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
            [['type', 'status', 'position', 'user_id', 'adult_passengers', 'child_count', 'category_id', 'flight_number_status', 'meeting_with_sign_status', 'car_on_the_go', 'classification', 'loading_required_status', 'floor', 'lift', 'shipping_house_type', 'shipping_house_floor', 'shipping_house_lift', 'delivery_house_type', 'delivery_house_floor', 'delivery_house_lift', 'alert_email', 'view_performers'], 'integer'],
            [['payed_sum', 'offer_your_price', 'weight', 'width', 'length', 'height', 'shipping_house_area', 'delivery_house_area'], 'number'],
            [['date_cr', 'date_close', 'date_begin'], 'safe'],
            [['shipping_address', 'delivery_address', 'comment', 'item_description'], 'string'],
            [['shipping_coordinate_x', 'shipping_coordinate_y', 'delivery_coordinate_x', 'delivery_coordinate_y', 'promo_code', 'flight_number', 'meeting_with_sign', 'car_model', 'car_mark', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransportCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'payed_sum' => 'Payed Sum',
            'status' => 'Status',
            'date_cr' => 'Date Cr',
            'date_close' => 'Date Close',
            'position' => 'Position',
            'user_id' => 'User ID',
            'shipping_address' => 'Shipping Address',
            'delivery_address' => 'Delivery Address',
            'shipping_coordinate_x' => 'Shipping Coordinate X',
            'shipping_coordinate_y' => 'Shipping Coordinate Y',
            'delivery_coordinate_x' => 'Delivery Coordinate X',
            'delivery_coordinate_y' => 'Delivery Coordinate Y',
            'date_begin' => 'Date Begin',
            'offer_your_price' => 'Offer Your Price',
            'promo_code' => 'Promo Code',
            'comment' => 'Comment',
            'adult_passengers' => 'Adult Passengers',
            'child_count' => 'Child Count',
            'category_id' => 'Category ID',
            'flight_number_status' => 'Flight Number Status',
            'flight_number' => 'Flight Number',
            'meeting_with_sign_status' => 'Meeting With Sign Status',
            'meeting_with_sign' => 'Meeting With Sign',
            'car_model' => 'Car Model',
            'car_mark' => 'Car Mark',
            'image' => 'Image',
            'car_on_the_go' => 'Car On The Go',
            'weight' => 'Weight',
            'width' => 'Width',
            'length' => 'Length',
            'height' => 'Height',
            'classification' => 'Classification',
            'loading_required_status' => 'Loading Required Status',
            'floor' => 'Floor',
            'lift' => 'Lift',
            'shipping_house_type' => 'Shipping House Type',
            'shipping_house_floor' => 'Shipping House Floor',
            'shipping_house_lift' => 'Shipping House Lift',
            'shipping_house_area' => 'Shipping House Area',
            'delivery_house_type' => 'Delivery House Type',
            'delivery_house_floor' => 'Delivery House Floor',
            'delivery_house_lift' => 'Delivery House Lift',
            'delivery_house_area' => 'Delivery House Area',
            'item_description' => 'Item Description',
            'alert_email' => 'Alert Email',
            'view_performers' => 'View Performers',
        ];
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
}
