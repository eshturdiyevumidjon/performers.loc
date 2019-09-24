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

    const SCENARIO_INF = 'change_information';
    const SCENARIO_PSW = 'change_password';


    public $avatar=null;
    public $new_password;
    public $old_password;
    public $re_password;
    public $permissions;


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
            [['email','username', 'auth_key','type'], 'required'],
            [['type', 'status','created_at', 'updated_at','alert_email','alert_site'], 'integer'],
            [['note', 'birthday','permissions'],'safe'],
            [['username', 'email', 'auth_key','address','language','new_password','old_password','re_password','password_reset_token','password_hash','role_performer','phone','image'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg',],
            [['email','username','phone'],'required', 'on' => self::SCENARIO_INF],
            [['new_password','old_password','re_password'],'validatePasswords', 'on' => self::SCENARIO_PSW],
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_INF] = ['email','address','username','type','birthday','language','phone','alert_email','alert_site'];

        $scenarios[self::SCENARIO_PSW] = ['new_password','old_password','re_password'];

        return $scenarios;
    }

    public function validatePasswords($attribute)
    { 
        if($this->old_password != $this->auth_key) 
            {
                $this->addError($attribute, Yii::t('app','Wrong old password.'));    
            }
        elseif($this->new_password != $this->re_password) 
            {
                $this->addError($attribute, Yii::t('app','"Password" and "Confirm password" do not match'));
            }
        elseif(preg_match_all('$S*(?=S{8,})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$', $new_password))
            {
                $this->addError($attribute, Yii::t('app','From 6 to 24 characters. Only latin letters, numbers and these characters: !@#$%^&amp;*()_+-=;,./?[]{}'));
            }        
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('app','Username'),
            'email' => Yii::t('app','Email'),
            'auth_key' => Yii::t('app','Password'),
            'password_hash' => Yii::t('app',''),
            'type' => Yii::t('app','Type'),
            'new_password'=>Yii::t('app','New password'),
            'birthday'=>Yii::t('app','Birthday'),
            'phone'=>Yii::t('app','Phone number'),
            'image'=>Yii::t('app','Image'),
            'note'=>Yii::t('app','Note'),
            'avatar'=>Yii::t('app','Image'),
            'language'=>Yii::t('app','Language'),
            'status' => Yii::t('app','Status'),
            'created_at' => Yii::t('app','Created_at'),
            'updated_at' => Yii::t('app','Updated_at'),
            'address' => Yii::t('app','City'),
            'role_performer'=>Yii::t('app','Access to order for the performer'),
            'permissions'=>Yii::t('app','Access to order for the performer'),
        ];
    }
    //Получить описание типов пользователя.
    public function getTypeDescription()
    {
        switch ($this->type) {
            case 0: return "Администратор";
            case 1: return "Модератор";
            case 2: return "Редактор";
            case 3: return "Исполнитель";
            case 4: return "Заказчика";
        }
    }
    public function getType()
    {
        return [
            0 => 'Администратор',
            1 => 'Модератор',
            2 => 'Редактор',
            3 => 'Исполнитель',
            4 => 'Заказчика',

        ];
    }
    public static function getTip()
    {
        return [
            0 => 'Администратор',
            1 => 'Модератор',
            2 => 'Редактор',
        ];
    }

    //Получить описание типов пользователя.
    public function getStatusDescription($status)
    {
        switch ($status) {
            case 0: return "Активен";
            case 10: return "Не активен";
        }
    }
    
    public static function getStatus()
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
            $this->alert_site = 1;
            $this->alert_email = 1;
        }
        else{
            $this->updated_at = time();
            if($this->new_password != null) {
                $this->auth_key = $this->new_password;
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->auth_key);
            }
        }
        $this->birthday = ($this->birthday) ? Yii::$app->formatter->asDate($this->birthday, 'php:Y-m-d') : '' ; 
        return parent::beforeSave($insert);
    }

    public function getCreated_at()
    {
        return Yii::$app->formatter->asDate($this->created_at, 'php:d.m.Y H:i:s'); 
    }

    public function getUpdated_at()
    {
        return Yii::$app->formatter->asDate($this->updated_at, 'php:d.m.Y H:i:s'); 
    }

    public function getBirthday()
    {
        return $this->birthday = ($this->birthday) ? Yii::$app->formatter->asDate($this->birthday, 'php:d.m.Y') : '' ;
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email]);
    }

    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => $phone]);
    }

    public function getUserAvatar($for='_form'){
        
        $adminka = Yii::$app->params['adminka'];
        
        if($for=='_form')
        return $this->image != null ? '<img style="width:100%; height:250px;" src="'.$adminka.'uploads/avatars/' . $this->image .'">' : '<img style="width:100%; height:250px;" src="'.$adminka.'uploads/nouser3.png">';
        if($for=='_columns')
           return $this->image != null ? '<img style="width:60px;" src="'.$adminka.'uploads/avatars/' . $this->image .' ">' : '<img style="width:60px;" src="'.$adminka.'uploads/nouser3.png">';
       if($for == 'head')
         return $this->image != null ? '<img style="width:34px;" src="'.$adminka.'uploads/avatars/' . $this->image .' ">' : '<img style="width:34px;" src="'.$adminka.'uploads/nouser3.png">';
    }
    
    public function getImageAddress()
    {
        $adminka = Yii::$app->params['adminka'];
        return $this->image != null ? $adminka.'uploads/avatars/' . $this->image : $adminka.'uploads/nouser3.png';
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
            // 'status' => self::STATUS_ACTIVE,
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
            // 'status' => self::STATUS_INACTIVE
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
    public function generateCode($count_char = 4)
    {
        $mass = ['1','2','3','4','5','6','7','8','9','0']; 
        $passw = ''; 
        $count = count($mass)-1; 
        for ($i=0; $i<$count_char; $i++) { 
            $passw .= $mass[mt_rand(0, $count)]; 
        } 
        $this->confirmation_code = $passw;
        $this->save(); 
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
  
    public function SortColumns($post)
    {
        $session = Yii::$app->session;

        $session['User[image]'] = 0;
        $session['User[username]'] = 0;
        $session['User[phone]'] = 0;
        $session['User[birthday]'] = 0;
        $session['User[created_at]'] = 0;
        $session['User[type]'] = 0;
        $session['User[status]'] = 0;
        $session['User[updated_at]'] = 0;
        $session['User[email]'] = 0;
            
        if( isset($post['User']['phone']) ) $session['User[phone]'] = 1;
        if( isset($post['User']['username']) ) $session['User[username]'] = 1;
        if( isset($post['User']['image']) ) $session['User[image]'] = 1;
        if( isset($post['User']['created_at']) ) $session['User[created_at]'] = 1;
        if( isset($post['User']['birthday']) ) $session['User[birthday]'] = 1;
        if( isset($post['User']['type']) ) $session['User[type]'] = 1;
        if( isset($post['User']['email']) ) $session['User[email]'] = 1;
        if( isset($post['User']['updated_at']) ) $session['User[updated_at]'] = 1;
        if( isset($post['User']['status']) ) $session['User[status]'] = 1;
    }

    public function getMonthList()
    {
        return
        [
            1 => Yii::t('app','January'),
            2 => Yii::t('app','February'),
            3 => Yii::t('app','March'),
            4 => Yii::t('app','April'),
            5 => Yii::t('app','May'),
            6 => Yii::t('app','June'),
            7 => Yii::t('app','July'),
            8 => Yii::t('app','August'),
            9 => Yii::t('app','September'),
            10 => Yii::t('app','October'),
            11 => Yii::t('app','November'),
            12 => Yii::t('app','December'),
        ];
    }

    public static function fill_unit_select_box()
    { 
     $langList = \backend\models\Lang::getLaguagesList();
     $output = '';
      foreach ($langList as $value) {
        $output .= '<option value="'.$value->url.'" class="test" data-thumbnail="'.$value->image.'">'.$value->name.'</option>';
            } 
     return $output;
    }
    public function isHaveRequest($id)
    {
        $request = \backend\models\Request::find()->where(['task_id'=>$id,'user_id'=>Yii::$app->user->identity->id])->count();
        return $request == 1;
    }
}