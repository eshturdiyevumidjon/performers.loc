<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\helpers\ArrayHelper;
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
            [['type', 'status','need_packing','packing_area','need_loader', 'demolition','need_relocation','count_relocation','need_furniture','count_furniture','need_piano','count_purchases','need_personal_items','need_purchases','count_personal_items','count_piano','demolition','need_building_materials','count_building_materials','need_special_equipments','count_special_equipments','need_other_items','count_other_items','count_loader', 'position', 'user_id', 'count_avtokreslo','count_buster','count_avtolulka','count_adult', 'return', 'category_id', 'flight_number_status', 'meeting_with_sign_status', 'car_on_the_go', 'loading_required_status', 'floor', 'lift', 'shipping_house_type', 'shipping_house_floor', 'shipping_house_lift', 'delivery_house_type', 'delivery_house_floor', 'delivery_house_lift', 'alert_email', 'view_performers'], 'integer'],
            [['payed_sum', 'offer_your_price', 'weight', 'width', 'length', 'height', 'shipping_house_area', 'delivery_house_area'], 'number'],
            [['date_cr', 'date_close', 'date_begin','date_begin2'], 'safe'],
            [['shipping_address', 'delivery_address','classification', 'comment', 'item_description'], 'string'],
            [['shipping_coordinate_x', 'shipping_coordinate_y', 'delivery_coordinate_x', 'delivery_coordinate_y', 'promo_code', 'flight_number', 'meeting_with_sign', 'car_model', 'car_mark', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransportCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [['type','shipping_address','delivery_address','date_begin','offer_your_price','count_adult','category_id','flight_number_status','meeting_with_sign_status'],'required', 'on' => self::SCENARIO_PASSENGERS],
            [['type','date_close','shipping_address','delivery_address','date_begin','offer_your_price','promo_code','car_model','car_mark','car_on_the_go'],'required', 'on' => self::SCENARIO_VEHICLES],
            [['type','date_close','shipping_address','delivery_address','date_begin','offer_your_price','weight','width','length','height','classification','loading_required_status'],'required', 'on' => self::SCENARIO_GOODS],
            [['type','date_close','shipping_address','delivery_address','date_begin','offer_your_price','comment','shipping_house_type','shipping_house_floor','shipping_house_lift','shipping_house_area','delivery_house_type','delivery_house_floor','delivery_house_lift','delivery_house_area','alert_email'],'required', 'on' => self::SCENARIO_HELP]

        ];
    }
 
     public function scenarios()
    {

        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_PASSENGERS] = ['type','count_avtolulka','date_begin2','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','date_begin2','offer_your_price','promo_code','comment','count_adult','return','category_id','flight_number_status','flight_number','meeting_with_sign_status','alert_email','meeting_with_sign'];

        $scenarios[self::SCENARIO_VEHICLES] = ['type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','comment','car_model','car_mark','image','alert_email','car_on_the_go'];

        $scenarios[self::SCENARIO_GOODS] = ['type','date_close','shipping_address','delivery_address','date_begin','offer_your_price','promo_code','comment','weight','width','length','height','classification','loading_required_status','floor','alert_email','lift'];

        $scenarios[self::SCENARIO_HELP] = ['need_packing','packing_area','need_loader', 'demolition','need_relocation','count_relocation','need_furniture','count_furniture','need_piano','count_purchases','need_personal_items','need_purchases','count_personal_items','count_piano','demolition','need_building_materials','count_building_materials','need_special_equipments','count_special_equipments','need_other_items','count_other_items','count_loader','type','payed_sum','status','date_cr','date_close','position','user_id','shipping_address','delivery_address','shipping_coordinate_x','shipping_coordinate_y','delivery_coordinate_x','delivery_coordinate_y','date_begin','offer_your_price','promo_code','comment','shipping_house_type','shipping_house_floor','shipping_house_lift','shipping_house_area','delivery_house_type','delivery_house_floor','delivery_house_lift','delivery_house_area','item_description','alert_email','view_performers'];

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
            'date_begin2' => Yii::t('app','Date and time of return transfer'),
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
            'count_adult' => Yii::t('app','Adult passengers Count'),
            'count_avtolulka' => Yii::t('app','Cild Count'),
            'count_avtokreslo' => Yii::t('app','Cild Count'),
            'count_buster' => Yii::t('app','Child Count'),
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
            'packing_area'=>Yii::t('app','Volume'),
            'need_packing'=>Yii::t('app','Need packing?'),
            'need_loader'=>Yii::t('app','Loaders'),
            'count_loader'=>Yii::t('app','Count Loaders'),
        ];
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->date_cr=Yii::$app->formatter->asDate(time(), 'php:Y-m-d');
            $this->user_id = Yii::$app->user->identity->id;
        }
        $this->date_cr=Yii::$app->formatter->asDate($this->date_cr, 'php:Y-m-d'); 
        $this->date_close=isset($this->date_close)?Yii::$app->formatter->asDate($this->date_close, 'php:Y-m-d'):''; 
        $this->date_begin=Yii::$app->formatter->asDate($this->date_begin, 'php:Y-m-d H:i'); 
        $this->date_begin2=isset($this->date_begin2)?Yii::$app->formatter->asDate($this->date_begin2, 'php:Y-m-d H:i'):''; 
        return parent::beforeSave($insert);
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->date_cr=isset($this->date_cr) ? Yii::$app->formatter->asDate($this->date_cr, 'php:d-m-Y') : ''; 
        $this->date_close=isset($this->date_close) ? Yii::$app->formatter->asDate($this->date_close, 'php:d-m-Y') : ''; 
        $this->date_begin=isset($this->date_begin) ? Yii::$app->formatter->asDate($this->date_begin, 'php:d-m-Y') : ''; 
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

    public function getCategoryList()
    {
        return ArrayHelper::map(TransportCategory::find()->all(),'id','name');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getCountDeti()
    {
        return $this->count_avtokreslo + $this->count_avtolulka + $this->count_buster;
    }
    public function getType()
    {
        return [
            '1' => Yii::t('app','Passenger Transportation'),
            '2' => Yii::t('app','Transportation of cars and equipment'),
            '3' => Yii::t('app','Freight transportation'),
            '4' => Yii::t('app','Relocation assistance'),
        ];
    }
    public function getTypeIconWhite()
    {
        switch ($this->type) {
            case '1': return '/images/bus.svg';
            case '2': return '/images/surface3.svg';
            case '3': return '/images/surface.svg';
            case '4': return '/images/surface4.svg';
        }
    }
     public function getTypeIconBlack()
    {
        switch ($this->type) {
            case '1': return '/images/bus_bl.svg';
            case '2': return '/images/surface1.svg';
            case '3': return '/images/surface_bl.svg';
            case '4': return '/images/surface4_bl.svg';
        }
    }
    
    public static function getTypeIconSvg($type)
    {
        switch ($type) {
            case '1': return '<svg xmlns="http://www.w3.org/2000/svg" width="75" height="40" viewBox="0 0 75 40"><g><g><path fill="" d="M2.499 28.743h2.5v-2.5h-2.5v-2.499h69.952c.007.17.03.339.03.509v1.99h-2.499v2.5h2.5v3.749h-5.124c0-.022-.015-.042-.02-.065a6.188 6.188 0 0 0-.324-1.041c-.049-.125-.115-.23-.171-.346a6.466 6.466 0 0 0-.361-.662c-.08-.125-.172-.239-.259-.357a6.475 6.475 0 0 0-.442-.536 6.388 6.388 0 0 0-.326-.319 5.915 5.915 0 0 0-.528-.434 11.01 11.01 0 0 0-.374-.262 6.692 6.692 0 0 0-.625-.336 16.865 16.865 0 0 0-.4-.186 6.206 6.206 0 0 0-.75-.23c-.124-.033-.241-.076-.368-.1a5.923 5.923 0 0 0-2.374 0c-.125.024-.25.067-.369.1a6.228 6.228 0 0 0-.75.23c-.137.055-.266.125-.398.186-.214.1-.423.213-.625.336-.125.083-.25.17-.375.262-.184.134-.36.28-.527.434a6.394 6.394 0 0 0-.327.32c-.156.17-.304.35-.442.535-.088.118-.179.232-.258.357a6.365 6.365 0 0 0-.361.662c-.057.116-.126.226-.172.346a6.238 6.238 0 0 0-.324 1.04c0 .024-.014.044-.02.066h-25.22c0-.022-.016-.042-.021-.065a6.285 6.285 0 0 0-.323-1.041c-.05-.125-.115-.23-.172-.346a6.464 6.464 0 0 0-.36-.662c-.08-.125-.172-.239-.26-.357a6.585 6.585 0 0 0-.442-.536 6.384 6.384 0 0 0-.326-.319 5.914 5.914 0 0 0-.527-.434 10.53 10.53 0 0 0-.375-.262 6.62 6.62 0 0 0-.625-.336 16.884 16.884 0 0 0-.399-.186 6.143 6.143 0 0 0-.743-.23c-.126-.033-.243-.076-.375-.1a5.817 5.817 0 0 0-2.326 0c-.065.012-.125.02-.194.034a6.237 6.237 0 0 0-1.015.316l-.186.082a6.282 6.282 0 0 0-.944.513l-.05.039a6.28 6.28 0 0 0-.805.664l-.125.115c-.19.192-.367.397-.53.612a6.344 6.344 0 0 0-.545-.625 2.974 2.974 0 0 0-.125-.115 6.33 6.33 0 0 0-.805-.664l-.05-.038a6.31 6.31 0 0 0-.944-.514l-.185-.081a6.276 6.276 0 0 0-1.016-.317c-.064-.013-.125-.022-.194-.035a5.813 5.813 0 0 0-2.325 0c-.125.026-.25.068-.37.1-.254.061-.505.139-.75.232-.136.055-.266.125-.398.186a6.52 6.52 0 0 0-.619.336c-.124.082-.25.17-.374.26-.184.136-.36.281-.528.436a6.462 6.462 0 0 0-.326.319c-.157.17-.304.35-.442.536-.087.117-.179.231-.259.356a6.328 6.328 0 0 0-.36.662c-.057.117-.126.227-.172.347a6.155 6.155 0 0 0-.324 1.04c0 .023-.015.043-.02.066H2.499zm0-16.246h7.498v8.748H2.5zm17.496 0v8.748h-7.498v-8.748zm9.997 0v8.748h-7.498v-8.748zm9.998 0v8.748h-7.498v-8.748zm9.997 0v8.748H42.49v-8.748zm9.998 0v8.748h-7.499v-8.748zM2.499 7.498h64.41a2.52 2.52 0 0 1 2.461 2.054l.112.446H2.5zM9.519 2.5h15.952L26.72 5H8.27zm62.588 18.573c.013.058.017.115.03.173h-9.653v-8.748h7.586zM61.235 37.49a3.749 3.749 0 1 1 0-7.498 3.749 3.749 0 0 1 0 7.498zm-37.492 0a3.749 3.749 0 1 1 0-7.497 3.749 3.749 0 0 1 0 7.497zm-9.996 0a3.75 3.75 0 1 1 0-7.498 3.75 3.75 0 0 1 0 7.498zm-6.124-2.499a6.227 6.227 0 0 0 11.122 2.46 6.227 6.227 0 0 0 11.122-2.46h25.244a6.248 6.248 0 0 0 12.247 0h6.373c.69 0 1.25-.56 1.25-1.25v-9.488c0-1.266-.148-2.527-.441-3.758L71.81 9.019A5.012 5.012 0 0 0 66.91 5H29.515L27.368.691A1.25 1.25 0 0 0 26.243 0H8.747A1.25 1.25 0 0 0 7.63.691L5.476 4.999H1.25c-.69 0-1.25.56-1.25 1.25V33.74c0 .69.56 1.25 1.25 1.25z"></path></g></g></svg>';
            case '2': return '<svg xmlns="http://www.w3.org/2000/svg" width="86" height="40" viewBox="0 0 86 40"><g><g><g><path fill="" d="M71.486 32.168a2.145 2.145 0 1 0 4.29 0 2.145 2.145 0 0 0-4.29 0z"></path></g><g><path fill="" d="M2.86 29.066l1.405-1.899h10.427c-.021.026-.034.057-.054.083a7.8 7.8 0 0 0-.767 1.156c-.02.038-.05.071-.07.11a7.847 7.847 0 0 0-.573 1.43c-.008.028-.024.05-.032.08H2.86zm11.438-7.62a2.82 2.82 0 1 1 2.86 2.86 2.86 2.86 0 0 1-2.86-2.86zm1.43 10.724a2.47 2.47 0 0 1 .031-.315l.032-.241a4.969 4.969 0 0 1 9.882 0l.032.241c.017.105.027.21.031.315a5.004 5.004 0 0 1-10.008 0zm6.354-7.864a5.664 5.664 0 0 0 .795-2.86h15.727a5.656 5.656 0 0 0 .795 2.86zm4.692 2.86h17.55v2.85H28.27c-.007-.028-.023-.05-.031-.08a7.966 7.966 0 0 0-.572-1.43c-.022-.04-.052-.074-.074-.113a7.9 7.9 0 0 0-.765-1.144c-.02-.026-.032-.058-.054-.083zm17.55-2.86a2.86 2.86 0 1 1 2.859-2.86 2.884 2.884 0 0 1-2.86 2.86zm2.859 2.86h12.868v5.719H47.183zm2.074-8.58a5.924 5.924 0 0 0-.351-.536c-.02-.025-.033-.052-.052-.076a5.79 5.79 0 0 0-.542-.609c-.057-.056-.12-.105-.178-.158a5.449 5.449 0 0 0-.442-.366c-.079-.058-.163-.11-.245-.165a6.132 6.132 0 0 0-.443-.266 8.397 8.397 0 0 0-.286-.143 6.246 6.246 0 0 0-.475-.195c-.094-.034-.188-.07-.285-.1a6.26 6.26 0 0 0-.542-.13c-.088-.017-.172-.04-.26-.053a5.25 5.25 0 0 0-1.66 0c-.088.013-.174.036-.261.053a6.17 6.17 0 0 0-.539.13c-.095.03-.19.066-.286.1a6.142 6.142 0 0 0-.76.339 5.07 5.07 0 0 0-.442.266c-.083.054-.167.107-.248.166a6.234 6.234 0 0 0-.438.364c-.06.055-.124.103-.18.16-.196.189-.377.392-.543.608-.017.022-.03.047-.047.069-.131.174-.252.355-.363.543h-9.364v-7.149h14.21l8.844 1.105a1.43 1.43 0 0 1 1.253 1.42v4.624zM41.653 8.579H30.026V2.86h6.29a2.86 2.86 0 0 1 2.372 1.275zm-14.487 2.86v7.148H22.1a6.015 6.015 0 0 0-.359-.537c-.019-.024-.033-.051-.051-.075a5.84 5.84 0 0 0-.543-.61c-.056-.055-.12-.104-.178-.157a5.4 5.4 0 0 0-.442-.366c-.078-.058-.163-.11-.245-.165a6.1 6.1 0 0 0-.442-.266 6.008 6.008 0 0 0-.76-.337c-.096-.035-.19-.071-.287-.1a5.989 5.989 0 0 0-.542-.131c-.087-.018-.172-.04-.26-.053a5.251 5.251 0 0 0-1.659 0c-.089.013-.174.035-.262.053a6.188 6.188 0 0 0-.538.13c-.095.03-.19.066-.287.1a5.992 5.992 0 0 0-.76.339 5.05 5.05 0 0 0-.442.266c-.083.054-.167.107-.247.166a6.104 6.104 0 0 0-.44.364c-.06.055-.122.103-.18.16-.194.189-.375.392-.542.608-.017.021-.03.047-.047.069-.13.174-.252.355-.363.543H7.15v-5.72c0-.789.64-1.429 1.43-1.429h18.587zm0-2.859H15.92l3.902-4.69a2.86 2.86 0 0 1 2.197-1.03h5.147zm35.744-1.43h6.549l2.059 10.294a1.43 1.43 0 0 0 1.39 1.144h.122l9.897.076v5.643H62.91zm0 22.876zm0 0v-2.858h4.685c-.022.026-.035.057-.055.083-.29.362-.546.748-.766 1.156-.022.038-.05.071-.072.11a7.887 7.887 0 0 0-.572 1.43c-.008.028-.031.05-.031.08zm10.724 7.15a5.004 5.004 0 0 1-5.004-5.005c.004-.106.014-.21.031-.315l.032-.241a4.968 4.968 0 0 1 9.882 0l.032.241c.016.105.027.21.031.315a5.004 5.004 0 0 1-5.004 5.004zm6.042-10.01h3.251v2.851h-1.755c-.007-.028-.023-.05-.032-.08a7.964 7.964 0 0 0-.572-1.43c-.021-.04-.051-.074-.073-.113a7.927 7.927 0 0 0-.764-1.144c-.02-.026-.034-.058-.055-.083zm2.136-11.37l-7.72-.059-1.716-8.587h4.04zM.286 27.746a1.43 1.43 0 0 0-.286.85v2.86c0 .789.64 1.429 1.43 1.429h11.474a7.863 7.863 0 0 0 15.656 0h15.764v1.43c0 .789.64 1.429 1.429 1.429H61.48c.79 0 1.43-.64 1.43-1.43v-1.43h2.895a7.864 7.864 0 0 0 15.656 0h2.895c.79 0 1.43-.64 1.43-1.429v-14.21c0-.296-.075-.587-.218-.846L78.42 4.961a1.429 1.429 0 0 0-1.212-.672H61.481c-.79 0-1.43.64-1.43 1.43v18.587H49.248a5.657 5.657 0 0 0 .794-2.86h5.72c.79 0 1.43-.64 1.43-1.43v-6.053a4.29 4.29 0 0 0-3.75-4.257L45.156 8.67l-4.082-6.124A5.71 5.71 0 0 0 36.316 0H22.02a5.703 5.703 0 0 0-4.387 2.056L12.2 8.578h-3.62a4.29 4.29 0 0 0-4.29 4.29v7.149c0 .79.64 1.43 1.43 1.43h5.72a5.658 5.658 0 0 0 .787 2.86H3.533a1.427 1.427 0 0 0-1.144.58z"></path></g><g><path fill="" d="M18.587 32.168a2.145 2.145 0 1 0 4.29 0 2.145 2.145 0 0 0-4.29 0z"></path></g></g></g></svg>';
            case '3': return '<svg xmlns="http://www.w3.org/2000/svg" width="86" height="40" viewBox="0 0 86 40"><g><g><g><path fill="" d="M2.857 2.857H57.15v24.286H2.857zm0 27.143h13.364c-.047.047-.092.104-.143.153a5.777 5.777 0 0 0-.686.786c-.057.08-.118.155-.173.238a5.708 5.708 0 0 0-.477.877c-.01.025-.016.052-.026.076a5.714 5.714 0 0 0-.247.727H4.878l-2.02-2.02zm14.288 4.286a2.857 2.857 0 1 1 5.715 0 2.857 2.857 0 0 1-5.715 0zM23.779 30h24.799v2.857H25.536a5.817 5.817 0 0 0-.247-.727c-.01-.024-.015-.051-.026-.075a5.711 5.711 0 0 0-.477-.877c-.054-.084-.116-.16-.173-.24a5.886 5.886 0 0 0-.686-.785c-.05-.049-.095-.106-.148-.153zm27.657 0h2.857v2.857h-2.857zm5.714 0h5.715v2.857H57.15zm8.573-15.714h2.858v7.143c0 .789.64 1.428 1.428 1.428h12.86v2.857H80.01v2.858h2.858v4.285h-4.462a5.39 5.39 0 0 0-.197-.572c-.035-.09-.057-.185-.096-.273a5.725 5.725 0 0 0-.487-.898c-.046-.064-.099-.117-.143-.178a5.48 5.48 0 0 0-.506-.613c-.084-.087-.176-.163-.264-.245a5.925 5.925 0 0 0-.512-.428 5.602 5.602 0 0 0-.899-.527 5.745 5.745 0 0 0-.355-.16 5.584 5.584 0 0 0-.676-.21c-.11-.028-.217-.065-.33-.086a5.34 5.34 0 0 0-2.143 0c-.113.021-.22.058-.33.086a5.617 5.617 0 0 0-.676.21c-.121.048-.238.104-.356.16a5.587 5.587 0 0 0-.571.31c-.112.074-.22.14-.327.217-.179.133-.35.276-.512.428-.088.082-.18.158-.264.245a5.41 5.41 0 0 0-.506.613c-.047.061-.1.114-.143.178a5.73 5.73 0 0 0-.487.898c-.038.088-.062.182-.096.273a5.512 5.512 0 0 0-.197.572h-1.61v-4.285zm4.286 20a2.857 2.857 0 1 1 5.715 0 2.857 2.857 0 0 1-5.715 0zM81.629 20h-4.476v-5.701c.44.028.841.258 1.089.622zm-7.334 0h-2.857v-5.714h2.857zM1.43 0C.64 0 0 .64 0 1.428v30c0 .379.15.742.419 1.01l2.857 2.857c.268.268.631.419 1.01.42H14.49a5.689 5.689 0 0 0 11.025 0h41.84a5.689 5.689 0 0 0 11.024 0h5.918c.79 0 1.429-.64 1.429-1.43v-12a4.267 4.267 0 0 0-.715-2.368l-4.386-6.58a4.286 4.286 0 0 0-3.572-1.909H64.294c-.789 0-1.429.64-1.429 1.429v14.286h-2.857V1.428C60.008.64 59.368 0 58.58 0z"></path></g><g><path fill="" d="M14.288 5.715H11.43v18.574h2.858z"></path></g><g><path fill="" d="M25.718 5.715H22.86v18.574h2.858z"></path></g><g><path fill="" d="M37.148 5.715H34.29v18.574h2.858z"></path></g><g><path fill="" d="M48.578 5.715H45.72v18.574h2.858z"></path></g></g></g></svg>';
            case '4': return '<svg xmlns="http://www.w3.org/2000/svg" width="67" height="40" viewBox="0 0 67 40"><g><g><g><path fill="" d="M64.442 24.442H62.22V22.22h2.222zm0 4.445h-4.444v2.222h4.444v2.222h-6.667a6.666 6.666 0 0 0-13.332 0H19.999a6.666 6.666 0 0 0-13.332 0H2.222v-2.222h3.333v-2.222H2.222V21.11h41.11v-2.223H2.222V4.444c0-1.228.995-2.223 2.223-2.223H50.16c.83-.006 1.59.455 1.97 1.192l.469 1.03h-3.712a3.333 3.333 0 0 0-3.333 3.333v5.556a3.333 3.333 0 0 0 3.333 3.333h9.667l4.902 3.268c.028.019.048.045.075.065H61.11a1.11 1.11 0 0 0-1.111 1.112v4.444c0 .613.497 1.11 1.11 1.11h3.334zm-8.978 5.333a4.444 4.444 0 1 1-8.71-1.78 4.444 4.444 0 0 1 8.71 1.78zm-37.777 0a4.445 4.445 0 1 1-8.709-1.78 4.445 4.445 0 0 1 8.71 1.78zM57.09 14.443h-8.202a1.11 1.11 0 0 1-1.11-1.111V7.776c0-.613.496-1.11 1.11-1.11H53.2zm7.596 3.641l-4.919-3.279-5.63-12.35A4.421 4.421 0 0 0 50.16 0H4.444A4.444 4.444 0 0 0 0 4.444v29.998c0 .614.497 1.111 1.111 1.111h5.954a6.642 6.642 0 0 0 12.536 0h25.24a6.642 6.642 0 0 0 12.537 0h8.175a1.11 1.11 0 0 0 1.111-1.11V21.11a3.501 3.501 0 0 0-1.979-3.026z"></path></g><g><path fill="" d="M45.554 18.887h5.555v2.223h-5.555z"></path></g><g><path fill="" d="M21.11 28.887h22.221v2.222h-22.22z"></path></g></g></g></svg>';
        }
    }

    public function getTypeOfTheGoods($type)
    {
        switch ($type) {
            case '1': return Yii::t('app','Oversized');
            case '2': return Yii::t('app','Fragile');
            default: return Yii::t('app','Dangerous');
        };
    }
    public function getTypeOfTheHouse($type)
    {
      return ($type == 1) ? Yii::t('app','House') : Yii::t('app','Apartment');
    }
    public function getYesNo($type)
    {
        return ($type == 1) ? Yii::t('app','Yes') : Yii::t('app','No');
    }

}
