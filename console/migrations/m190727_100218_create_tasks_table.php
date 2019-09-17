<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m190727_100218_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->comment("Тип"),
            'payed_sum' => $this->float()->comment("Сколько оплатил клиент"),
            'status' => $this->integer()->defaultValue(0)->comment("Статус"),
            'date_cr' => $this->date()->comment("Дата создание заданий"),
            'date_close' => $this->date()->comment("Дата закрытые заданий"),
            'position' => $this->integer()->comment("Состояние"),
            'user_id' => $this->integer()->comment("Заказчик"),
            'shipping_address' => $this->text()->comment("Адрес отгрузки"),
            'delivery_address' => $this->text()->comment("Адрес доставки"),
            'shipping_coordinate_x' => $this->string()->comment("Shipping Coordinate X"),
            'shipping_coordinate_y' => $this->string()->comment("Shipping Coordinate Y"),
            'delivery_coordinate_x' => $this->string()->comment("Delivery Coordinate X"),
            'delivery_coordinate_y' => $this->string()->comment("Delivery Coordinate Y"),
            'date_begin' => $this->datetime()->comment("Дата и время начала трансфера"),
            'offer_your_price' => $this->float()->comment("Предложить свою цену"),
            'promo_code' => $this->string(255)->comment("Промо-код"),
            'comment' => $this->text()->comment("Комментария"),
            'performer_id' => $this->integer()->comment("Исполнитель"),

            //Пассажирские перевозки uchun kerakli polyalar

            'count_adult' => $this->integer()->defaultValue(0)->comment("Количество взрослых пассажиров"),
            'date_begin2' => $this->datetime()->comment("Дата и время начала обратного трансфера"),
            'count_avtolulka' => $this->integer()->defaultValue(0)->comment("Количество детей(до 10 кг, до 6 месяцев)"),
            'count_avtokreslo' => $this->integer()->defaultValue(0)->comment("Количество детей(9–25 кг, 0–7 лет)"),
            'count_buster' => $this->integer()->defaultValue(0)->comment("Количество детей(22–36 кг, 6–12 лет)"),
            'return' => $this->integer()->defaultValue(0)->comment("Добавить обратный маршрут"),
            'category_id' => $this->integer()->comment("Категория транспорта"),
            'flight_number_status' => $this->boolean()->comment("Номер авиа или ж/д рейса"),
            'flight_number' => $this->string(255)->comment("Номер авиа или ж/д рейса"),
            'meeting_with_sign_status' => $this->boolean()->comment("Встреча с табличкой"),
            'meeting_with_sign' => $this->string(255)->comment("Встреча с табличкой"),

            //Перевозка автомобилей и техники uchun kerakli polyalar

            'car_model' => $this->string(255)->comment("Модель автомобиля"),
            'car_mark' => $this->string(255)->comment("Марка автомобиля"),
            'image' => $this->string(255)->comment("Фото"),
            'car_on_the_go' => $this->integer()->comment("Автомобиль на ходу"),

            //Грузовые перевозки uchun kerakli polyalar

            //Параметры
            'weight' => $this->float()->comment("Вес"),
            'width' => $this->float()->comment("Ширина"),
            'length' => $this->float()->comment("Длина"),
            'height' => $this->float()->comment("Высота"),
            'classification' => $this->string(255)->comment("Классификация"),
            'loading_required_status' => $this->integer()->comment("Требуется погрузка/разгрузка"),
            'floor' => $this->integer()->comment("Этаж"),
            'lift' => $this->integer()->comment("Лифт"),

            //Помощь в переезде uchun kerakli polyalar
            'shipping_house_type' => $this->integer()->comment("Дом/квартира"),
            'shipping_house_floor' => $this->integer()->comment("Этаж"),
            'shipping_house_lift' => $this->integer()->comment("Лифт"),
            'shipping_house_area' => $this->float()->comment("Площадь"),
            'delivery_house_type' => $this->integer()->comment("Дом/квартира"),
            'delivery_house_floor' => $this->integer()->comment("Этаж"),
            'delivery_house_lift' => $this->integer()->comment("Лифт"),
            'delivery_house_area' => $this->float()->comment("Площадь"),
            'item_description' => $this->text()->comment("Описание предметов"),
            'alert_email' => $this->integer()->comment(""),
            'view_performers' => $this->integer()->comment(""),
            'need_packing' => $this->integer()->defaultValue(0)->comment("Нужна ли упаковка"),
            'packing_area' => $this->integer()->comment("Объём"),
            'need_loader' => $this->integer()->defaultValue(0)->comment('Грузчики'),
            'count_loader' => $this->integer()->comment('Количество грузчиков'),
            'demolition' => $this->integer()->defaultValue(0)->comment('Нужна разборка'),
            
            'need_relocation' => $this->integer()->defaultValue(0)->comment('переезды'),
            'count_relocation' => $this->integer()->comment('Количество переезды'), 
            'need_furniture' => $this->integer()->defaultValue(0)->comment('Мебель и бытовая техника'),
            'count_furniture' => $this->integer()->comment('Количество Мебель и бытовая техника'), 
            'need_personal_items' => $this->integer()->defaultValue(0)->comment('Личные вещи'),
            'count_personal_items' => $this->integer()->comment('Количество Личные вещи'), 
            'need_purchases' => $this->integer()->defaultValue(0)->comment('Покупки'),
            'count_purchases' => $this->integer()->comment('Количество Покупки'), 
            'need_piano' => $this->integer()->defaultValue(0)->comment('Пианино и сейфы'),
            'count_piano' => $this->integer()->comment('Количество Пианино и сейфы'),
            'need_building_materials' => $this->integer()->defaultValue(0)->comment('Стройматериалы'),
            'count_building_materials' => $this->integer()->comment('Количество Стройматериалы'), 
            'need_special_equipments' => $this->integer()->defaultValue(0)->comment('Спецтехника и негабарит'),
            'count_special_equipments' => $this->integer()->comment('Количество Спецтехника и негабарит'),
            'need_other_items' => $this->integer()->defaultValue(0)->comment('Прочие грузы'),
            'count_other_items' => $this->integer()->comment('Количество Прочие грузы'),


        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-tasks-user_id}}',
            '{{%tasks}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-tasks-user_id}}',
            '{{%tasks}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

         // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-tasks-category_id}}',
            '{{%tasks}}',
            'category_id'
        );

        // add foreign key for table `{{%transport_category}}`
        $this->addForeignKey(
            '{{%fk-tasks-category_id}}',
            '{{%tasks}}',
            'category_id',
            '{{%transport_category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-tasks-user_id}}',
            '{{%tasks}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-tasks-user_id}}',
            '{{%tasks}}'
        );
         // drops foreign key for table `{{%transport_category}}`
        $this->dropForeignKey(
            '{{%fk-tasks-category_id}}',
            '{{%tasks}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-tasks-category_id}}',
            '{{%tasks}}'
        );

        $this->dropTable('{{%tasks}}');
    }
}
