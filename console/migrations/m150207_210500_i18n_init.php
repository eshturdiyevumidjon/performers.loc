<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use yii\db\Migration;

/**
 * Initializes i18n messages tables.
 *
 *
 *
 * @author Dmitry Naumenko <d.naumenko.a@gmail.com>
 * @since 2.0.7
 */
class m150207_210500_i18n_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%source_message}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string(),
            'message' => $this->text(),
        ], $tableOptions);

        $this->createTable('{{%message}}', [
            'id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'translation' => $this->text(),
        ], $tableOptions);

        $this->addPrimaryKey('pk_message_id_language', '{{%message}}', ['id', 'language']);
        $this->addForeignKey('fk_message_source_message', '{{%message}}', 'id', '{{%source_message}}', 'id', 'CASCADE', 'RESTRICT');
        $this->createIndex('idx_source_message_category', '{{%source_message}}', 'category');
        $this->createIndex('idx_message_language', '{{%message}}', 'language');

        $translations = [
                'User'=>'Пользователь',
                'Close'=>'Закрыть',
                'Edit'=>'Изменить',
                'Users'=>'Пользователи',
                'Complete successfully'=>'Успешно выполнено',
                'Create more'=>'Создать ещё',
                'Create new user'=>'Создать нового пользователя',
                'Save'=>'Сохранить',
                'Update user'=>'Изменить пользователя',
                'Username'=>'ФИО',
                'Email'=>'Логин',
                'Password'=>'Пароль',
                'Type' =>'Тип',
                'New password'=>'Новый пароль',
                'Birthday'=>'День рождения',
                'Phone number'=>'Номер телефона',
                'Image'=>'Фото',
                'Created_at'=>'Дата создания',
                'Updated_at'=>'Дата изменения',
                'Add'=>'Добавить',
                'Sort Columns'=>'Сортировка',
                'Are you sure?'=>'Подтвердите действие',
                'Really do you want delete this item'=>'Вы уверены что хотите удалить этого элемента?',
                'Are you sure want to delete this item?'=>'Вы уверены что хотите удалить этого элемента?',
                'Delete All' =>'Удалить все',
                'Users listing'=>'Список пользователей',
                'Dashboard'=>'Рабочий стол',
                'Settings'=>'Настройки',
                'Clients'=>'Клиенты',
                'Language'=>'Язык',
                'Translations'=>'Переводы',
                'Do you want to leave the site?'=>'Вы хотите покинуть сайт?',
                'Click No if you want to continue. Click Yes to log out of the current user.'=>'Нажмите Нет, если вы хотите продолжить работу. Нажмите «Да», чтобы выйти из текущего пользователя.',
                'Leave the site?'=> 'Выйти из  сайта?',
                'Yes'=>'Да',
                'No'=>'Нет',
                //lang
                'Language Code'=>'Код языка',
                'Name'=>'Название',
                'Local'=>'Локальный',
                'Create'=>'Создать',
                'Image'=>'Фото',
                'Default'=>'',
                'Status'=>'Статус',
                'Date Update'=>'Дата изменения',
                'Date Create'=>'Дата создания',
                'Languages'=>'Языки',
                'Languages listing'=>'Список языков',
                'View'=>'Пpосмотр',
                'Delete'=>'Удалить',
                'Update'=>'Изменить',
                'The above error occurred while the Web server was processing your request. Please contact us if you think this is a server error. Thank you.'=>' Вышеуказанная ошибка произошла, когда веб-сервер обрабатывал ваш запрос. Пожалуйста, свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо.',
                'Back to dashboard'=>'Вернуться к рабочий стол',
                'Previous page'=>'Предыдущая страница',
                'Enter your login information'=>'Введите данные для входа',
                
                ''=>'',
                //transports

                'Transports'=>'Транспорты',
                'Model'=>'Модель',
                'Mark'=>'Марка',
                'Driver'=>'Водитель',
                'Owner'=>'Владелец',
                'Transports listing'=>'Список транспортов ',
                'Customers'=>'Заказчики',
                'Customer'=>'Заказчик',
                'Performers'=>'Исполнители',
                'Performer'=>'Исполнителя',
                'not-set'=>'не задано',

                //About-company
                'About Company'=>'О компании',
                'Cancel'=>'Назад',
                'Email address'=>'Адрес электронной почты',
                'Note'=>'Заметка',
                //Banners
                'Banners'=>'Баннеры',
                'Banners listing'=>'Список баннеров',
                'Title'=>'Заголовок',
                'Text'=>'Текст',
                'Link'=>'Ссылка',
                'Image'=>'Фото',
                'Type'=>'Тип',

                //News
                'News'=>'Новости',
                'News listing' => 'Список новостей',

                //'Transport category',
                'Category of transports'=>'Категория транспорта',
                'Category'=>'Категория',
                'Transport Categories listing'=>'Список транспортных категорий',

                //Tasks
                'Tasks'=>'Задания',
                'Tasks listing'=>'Список задач',
                'Transportation of cars and equipment'=>'Перевозка автомобилей и техники',
                'Freight transportation'=>'Грузовые перевозки',
                'Relocation assistance'=>'Помощь в переезде',
                'Passenger Transportation'=>'Пассажирские перевозки',
                'Date Create'=>'Дата создания',
                'Date Close'=>'Дата окончания срока задания',
                'Payed Sum'=>'Оплаченная сумма',
                'Position'=>'Состояние',
                'Client'=>'Заказчик',
                'Shipping Address'=>'Адрес отгрузки',
                'Delivery Address'=>'Адрес доставки',
                'Add return route'=>'Добавить обратный маршрут',
                'Number of passengers'=>'Количество пассажиров',
                'Date Begin'=>'Дата начала срока задания',
                'Price'=>'Цена',
                'Publish'=>'Опубликовать',
                'Promo Code'=>'Промо код',
                'Comment'=>'Комментарий',
                'Passengers'=>'Пассажиры',
                'Adult passengers Count'=>'Количество взрослых пассажиров',
                'Child Count'=>'Количество детей',
                'Category of transport'=>'Категория транспорта',
                'Air or railway flight number'=>'Номер авиа или ж/д рейса',
                'Meeting With Sign'=>'Встреча с табличкой',
                'Car model'=>'Модель автомобиля',
                'Car mark'=>'Марка автомобиля',
                'Car On The Go'=>'Автомобиль на ходу',
                'Weight'=>'Вес',
                'Cargo'=>'Груз',
                'Adults'=>'Взрослые',
                'Children'=>'Дети',
                'Loaders'=>'Грузчики',
                'Need to pack'=>'Нужно упаковать',
                'Count Loaders' => 'Количество грузчиков',
                'Need packing?'=>'Нужна ли упаковка?',
                'Volume'=>'Объём',
                'Other goods'=>'Прочие грузы',
                'Purchases'=>'Покупки',
                'Special equipment and oversized'=>'Спецтехника и негабарит',
                'Personal items'=>'Личные вещи',
                'Building materials'=>'Стройматериалы',
                'Furniture and household appliances'=>'Мебель и бытовая техника',
                'Piano and safes'=>'Пианино и сейфы',
                'Relocation'=>'Переезд',
                'Need disassembly'=>'Нужна разборка',
                'Train/Flight Number'=>'Номер ж/д рейса',
                'Date and time of return transfer'=>'Дата и время обратного трансфера',
                'Create Order'=>'Создание заказа',
                'Width'=>'Ширина',
                'Length'=>'Длина',
                'Height'=>'Высота',
                'Classification'=>'Классификация',
                'Required load'=>'Требуется погрузка/разгрузка',
                'House'=>'Дом',
                'Apartment'=>'Квартира',
                'Floor'=>'Этаж',
                'Lift'=>'Наличие лифта',
                'Shipping date'=>'Дата отправки',
                'Arrival date'=>'Дата прибытия',
                'Created'=>'Cоздан',
                'Offer'=>'Предложение',
                'Additional options'=>'Дополнительные параметры',
                'Description'=>'Описание',
                'Area'=>'Площадь',
                'Select a transport category'=>'Выбор категории транспорта',
                'Shipping House'=>'Дом отгрузки',
                'Delivery House'=>'Дом доставки',
                'Description items'=>'Описание предметов',
                'Alert Email'=>'Показывать уведомления посредством электронной почты',
                'Only performers'=>'Только исполнители',
                'Additional terms'=>'Дополнительные условия',
                'Start date and time when the shipment is ready to ship'=>'Начальная  дата и время когда груз будет готов к отправке',
                'The maximum possible date and time when the cargo must be a destination point'=>'Максимальная возможная  дата и  время, когда  груз  должен быть точка назначения',
                'Start date and time when the passengers is ready to ship'=>'Дата и время начала, когда пассажиры готовы к отправке',
                'The maximum possible date and time when the passengers must be a destination point'=>'
                Максимально возможная дата и время, когда пассажиры должны быть пунктом назначения',
                'Point of departure'=>'Пункт отправки',
                'Destination'=>'Пункт назначения',
                'Date'=>'Дата',
                'Arrival date'=>'Дата приезда',
                'Time of arrival'=>'Время приезда',
                'Model and brand of car'=>'Модель и марка автомобиля',
                'Address'=>'Адрес',
                'Cargo Parameters'=>'Параметры груза',
                'Oversized'=>'Крупногабаритный',
                'Fragile'=>'Хрупкий',
                'Dangerous'=>'Опасный',

                //chat
                'Chat' => 'Переписки',
                'COMPOSE' => 'НАПИСАТЬ',
                'About' => 'О Нас',
                'Coordinate X'=>'Координата X',
                'Coordinate Y'=>'Координата Y',
                'Phone'=>'Телефон',
                'Phone numbers'=>'Телефонные номера',
                'Key'=>'Ключ',
                'Answers'=>'Ответы',
                'Logout' => 'Выйти',

                //frontent
                'Contact'=>'Контакты',
                'online'=>'в сети',
                'Telephone numbers'=>'Телефонные номера',
                'Feedback form'=>'Форма обратной связи',
                'Create my account'=>'Создать мою учетную запись',
                'FAQ'=>'ЧаВо',
                'Frequently Asked Questions'=>'Частые вопросы',
                'Verify phone number'=>'Подтвердите номер телефона',
                'Home'=>'Главная',
                'Service'=>'Служба поддержки',
                'Blog'=>'Блог',
                '© 2011—2019 «iTake» LLC. By using the site, you agree to be bound by the terms'=>
                '© 2011—2019 OOO «iTake». Используя сайт, вы обязуетесь выполнять условия',
                'User agreement.'=>'Пользовательского соглашения.',
                'Created by:'=>'Создание сайта: ',
                'Login / Register'=>'Вход/Регистрация',
                'Invoice:'=>'Счет:',
                'Urgent delivery of your goods'=>'Срочная доставка ваших грузов',
                'We connect with professional carriers near you!'=>'Соединяем с профессиональными перевозчиками рядом с Вами!',
                'STEP 1'=>'ШАГ 1-Й',
                'STEP 2'=>'ШАГ 2-Й',
                'STEP 3'=>'ШАГ 3-Й',
                'Register or download the application'=>'Зарегистрируйся или скачай приложение',
                'Calculate the cost of transportation and place your order using the pre-order form.'=>'Рассичитайте стоимость перевозки и оформите  заказ с помощь формы предварительного заказа.',
                'Choose a performers and pay for the service'=>'Выбери исполнителя и оплати услугу',
                'First create a task, in the process of registration'=>'Сначала создай задание, в процессе регисратция',
                'Transporting cargo is much easier than you think.'=>'Перевозите груз гораздо проще чем вы думаете.',
                'Download'=>'Скачай',
                'app'=>'приложение',
                'Find Our app in Play Market and'=>'Найди наше приложение в Play Market и',
                'Create a task during'=>'Cоздай задание во времья',
                'registration'=>'регистрация',
                'In one page Registr and Create'=>'Регистрируйся и в этом же окне создай',
                'task. Everything is simple, save time.'=>'задание. Все просто, экономим время.',
                'Choose'=>'Выбери',
                'performer'=>'исполнителя',
                'and pay for the service'=>'и оплати услугу',
                'Start negotiations with the contractor.'=>'Начни вести переговоры с исполнителем.',
                'Personal'=>'Персональный',
                'assistant in'=>'помощник в',
                'in your pocket'=>'вашем кармане',
                'Download our application and use'=>'Скачайте наше приложение и пользуйтесь',
                'itake, wherever you are.'=>'itake, где бы вы ни находились.',
                'on the net'=>'в сети',
                'Request password reset'=>'Восстановление пароля',
                'Restore password'=>'Восстановить пароль',
                'Code'=>'Код',
                'Send'=>'Отправить',
                'Message'=>'Сообщение',

                //registr
                'New password'=>'Новый пароль',
                'Confirm password'=>'Повторите пароль',
                'Phone number or email address'=>'Номер телефона или E-mail',
                'Remember me'=>'Запомни меня',
                'Login'=>'Вход',
                'Signup'=>'Регистрация',
                'Forgot your password?'=>'Забыли пароль?',
                'Don\'t have an account yet?'=>'У вас еще нет аккаунта?',
                'Create an account'=>'Создать аккаунт',
                'Authorization'=>'Авторизация',
                'Profile'=>'Профиль',
                'Select'=>'Выберите',
                'Navigation'=>'Навигация',
                'More'=>'Подробнее',
                'Message'=>'Сообщение',
                'Surname and name / Company name'=>'Фамилия и имя/Название компании',
                '"Password" and "Confirm password" do not match'=>'«Пароль» и «Повторный ввод пароля» не совпадают',
                'This email address is already taken.'=>'Этот адрес электронной почты уже занят.',
                //Feedback
                'Feedbacks listing'=>'Список отзывов',
                'Feedbacks'=>'Отзыв',
                'Reply'=>'Ответить',
                'Thank you for contacting us. We will respond to you as soon as possible.'=>'Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.',
                'There was an error sending your message.'=>'При отправке вашего сообщения произошла ошибка.',
                'Registration'=>'Регистрация',
                'Create Task'=>'Создать задание',
                'Personal Cabinet'=>'Личный кабинет',
                'My Orders'=>'Мои заказы',
                'Past Orders'=>'Прошедшие заказы',
                'Edit Account'=>'Редактировать данные',
                'Adding Drivers'=>'Добавление водителей',
                'Edit Profile'=>'Редактирование профиля',
                'New password saved.'=>'Новый пароль сохранен.',
                'Check your email for further instructions.'=>'Проверьте свою электронную почту для дальнейших инструкций.',
                'Sorry, we are unable to reset password for the provided email address.'=>'К сожалению, мы не можем сбросить пароль для указанного адреса электронной почты.',
                'Verify Account'=>'Подтвердить учетную запись',
                'Day'=>'День',
                'Month'=>'Месяц',
                'Year'=>'Год',
                'City'=>'Город',
                'Language'=>'Язык',
                'Check your information.Something wrong.'=>'Проверьте вашу информацию. Что-то не так.',
                'Changes saved.'=>'Изменения сохранены.',
                'From 6 to 24 characters. Only latin letters, numbers and these characters: !@#$%^&amp;*()_+-=;,./?[]{}'=>'От 6 до 24 символов. Допустимы латинские буквы, цифры и следующие спецсимволы: !@#$%^&amp;*()_+-=;,./?[]{}',
                'Old Password'=>'Старый пароль',
                'New Password'=>'Новый пароль',
                'Wrong old password.'=>'Неверный старый пароль.',
                'Password cannot be blank.'=>'Пароль не может быть пустым.',
                'Password must be contain from 6 to 24 characters'=>'Пароль должен содержать от 6 до 24 символов',
                'Drivers listing'=>'Список драйверов',
                'Registration Number'=>'Регистрационный номер',
                'Incorrect username or password.'=>'Неверное имя пользователя или пароль.',

                'January'=>'Январь',
                'February'=>'Февраль',
                'March'=>'Март',
                'April'=>'Апрель',
                'May'=>'Май',
                'June'=>'Июнь',
                'July'=>'Июль',
                'August'=>'Август',
                'September'=>'Сентябрь',
                'October'=>'Октябрь',
                'November'=>'Ноябрь',
                'December'=>'Декабрь',
                'Adding cars'=>'Добавление автомобилей',
                'Upload a photo'=>'Загрузить фото',
                'Add driver'=>'Добавить водителя',   
                'Passed verification'=>'Прошел проверку',
                'Moderator'=>'Модератора',
                'Verified Contacts'=>'Подтвержденные контакты',
                'Languages'=>'Языки',
                'Increase user confidence in yourself - link your social network accounts to your iTake profile. We will not disclose your contact information.'=>'Повысьте доверие пользователей к себе –  привяжите ваши аккаунты социальных сетей к профилю iTake. Мы обязуемся не раскрывать ваши контакты.',
                'General settings'=>'Общие настройки',
                'Change password'=>'Сменить пароль',
                'The phone is hidden from other users'=>'Телефон скрыт от других пользователей',
                'Email address is hidden from other users'=>'Почтовый адрес скрыт от других пользователей',
                'Receive notifications:'=>'Получать уведомления:',
                'Receive notifications when applications are received by e-mail'=>'Получать уведомления при поступлении заявок по электронные почте',
                'I want to receive site news'=>'Я хочу получать новости сайта',
                'Only performers can subscribe to assignments'=>'Подписываться на задания могут только исполнители',
                'with a verified account.'=>'с подтвержденным аккаунтом.',
                'Change photo'=>'Изменить фото',
                'View Available Jobs'=>'Просмотр доступных заданий',
                'My active tasks'=>'Мои активные задачи',
                'Filter'=>'Фильтр',
                'Car transportation'=>'Перевозка автомобиль',
                'Cost'=>'Стоимость',
                'Date'=>'Дата',
                'from'=>'от',
                'to'=>'до',
                'Reset'=>'Сбросить',
                'Apply'=>'Применить',
                'Organization of your work'=>'Организация вашей работы',
                'Adding a structure to organize your work.'=>'Добавление структуры для организации вашей работы.',
                'Работа в командах'=>'Team work',
                'Inviting other people, collaboration and notifications.'=>'Приглашение других людей, сотрудничество и уведомления.',
                'Use on your phone'=>'Использование на вашем телефоне',
                'How to access iTake on your iPhone or Android device.'=>'Как получить доступ к iTake на вашем устройстве iPhone или Android.',
                'Performer\'s profile'=>'Профиль Исполнителя',
                'Customer\'s Profile'=>'Профиль Заказчика',
                'Add car'=>'Добавить машину',
                'Blog'=>'Блог'
            ];

        $keys = array_keys($translations);
        $values = array_values($translations);

        foreach ($keys as $key => $value) {
              $this->insert('{{%source_message}}',array(
            'message' => $value,
            'category' => 'app'
            ));
        };

        foreach ($values as $key => $value) {
              $this->insert('{{%message}}',array(
            'id' => ($key+1),
            'language' => 'ru',
            'translation' => $value
            ));
        };
        foreach ($keys as $key => $value) {
              $this->insert('{{%message}}',array(
            'id' => ($key+1),
            'language' => 'en',
            'translation' => $value
            ));
        }
    }

    public function down()
    {
        $this->dropForeignKey('fk_message_source_message', '{{%message}}');
        $this->dropTable('{{%message}}');
        $this->dropTable('{{%source_message}}');
    }
}
