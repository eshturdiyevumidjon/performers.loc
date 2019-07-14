<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $avatar=null;
    public $new_password;
    public $new_password2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username','fio', 'auth_key','type','birthday'], 'required'],
            [['type', 'status','created_at', 'updated_at'], 'integer'],
            [['birthday','note'],'safe'],
            [['fio', 'username', 'auth_key','new_password', 'password_hash','phone','image'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg',],
            [['new_password','new_password2'],'validatePassword'],
        ];
    }
     public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'username' => 'Логин',
            'auth_key' => 'Пароль',
            'password_hash' => 'Password Hash',
            'type' => 'Тип',
            'new_password'=>'Новый пароль',
            'birthday'=>'День рождения',
            'phone'=>'Телефон',
            'image'=>'Фото',
            'avatar'=>'Фото',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }
    //Получить описание типов пользователя.
    public function getTypeDescription()
    {
        switch ($this->type) {
            case 0: return "Администратор";
            case 1: return "Модератор";
            case 2: return "Редактор";
        }
    }
    public function getType()
    {
        return [
            0 => 'Администратор',
            1 => 'Модератор',
            2 => 'Редактор',
        ];
    }

    //Получить описание типов пользователя.
    public function getStatusDescription()
    {
        switch ($this->type) {
            case 0: return "Активен";
            case 10: return "Не активен";
            default: return "Неизвестно";
        }
    }
     public function getStatus()
    {
        return [
            0 => 'Активен',
            10 => 'Не активен',
        ];
    }

     public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->auth_key);
            $this->status = 10;
            $this->updated_at = time();
            $this->created_at = time();      
        }

        if(!$this->isNewRecord) { $this->updated_at=time();
             if($this->new_password != null) {
                $this->auth_key = $this->new_password;
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->auth_key);
            }

        }

        if($this->birthday != null)
            $this->birthday = \Yii::$app->formatter->asDate($this->birthday, 'php:Y-m-d');
        return parent::beforeSave($insert);
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->birthday=Yii::$app->formatter->asDate($this->birthday, 'php:d.m.Y'); 
        $this->created_at=Yii::$app->formatter->asDate($this->created_at, 'php:d.m.Y'); 
        $this->updated_at=Yii::$app->formatter->asDate($this->updated_at, 'php:d.m.Y'); 
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    public function getUserAvatar($for='_form'){
        if($for=='_form')
        return $this->image != null ? '<img style="width:100%; height:250px;" src="http://' . $_SERVER["SERVER_NAME"] . "/uploads/avatars/" . $this->image .' ">' : '<img style="width:100%; height:250px;" src="http://' . $_SERVER["SERVER_NAME"].'/uploads/nouser.jpg">';
        if($for=='_columns')
            return $this->image != null ? '<img style="width:60px;" src="http://' . $_SERVER["SERVER_NAME"] . "/uploads/avatars/" . $this->image .' ">' : '<img style="width:60px;" src="http://' . $_SERVER["SERVER_NAME"].'/uploads/nouser.jpg">';
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function checkAll($id)
    {
        $session = Yii::$app->session;

        $session['User[image]'] = $id;
        $session['User[fio]'] = $id;
        $session['User[phone]'] = $id;
        $session['User[birthday]'] = $id;
        $session['User[created_at]'] = $id;
        $session['User[type]'] = $id;
        $session['User[status]'] = $id;
        $session['User[updated_at]'] = $id;
        $session['User[username]'] = $id;
    }
    
    public function SortColumns($post)
    {
        $session = Yii::$app->session;

        $session['User[image]'] = 0;
        $session['User[fio]'] = 0;
        $session['User[phone]'] = 0;
        $session['User[birthday]'] = 0;
        $session['User[created_at]'] = 0;
        $session['User[type]'] = 0;
        $session['User[status]'] = 0;
        $session['User[updated_at]'] = 0;
        $session['User[username]'] = 0;
            
        if( isset($post['User']['phone']) ) $session['User[phone]'] = 1;
        if( isset($post['User']['fio']) ) $session['User[fio]'] = 1;
        if( isset($post['User']['image']) ) $session['User[image]'] = 1;
        if( isset($post['User']['created_at']) ) $session['User[created_at]'] = 1;
        if( isset($post['User']['birthday']) ) $session['User[birthday]'] = 1;
        if( isset($post['User']['type']) ) $session['User[type]'] = 1;
        if( isset($post['User']['username']) ) $session['User[username]'] = 1;
        if( isset($post['User']['updated_at']) ) $session['User[updated_at]'] = 1;
        if( isset($post['User']['status']) ) $session['User[status]'] = 1;
    }
    
}
