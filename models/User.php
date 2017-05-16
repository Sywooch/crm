<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $lastname
 * @property string $firstname
 * @property string $patronimyc
 * @property string $post
 * @property string $email
 * @property string $phone
 * @property string $mobilephone
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 *
 * @property Project[] $projects
 * @property Project[] $projects0
 * @property Relationship[] $relationships
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    public $password_confirm;

    const SCENARIO_RESET_PASSWORD = 'reset_password';

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['firstname', 'lastname', 'patronimyc', 'email', 'post', 'phone', 'mobilephone'],
            self::SCENARIO_RESET_PASSWORD => ['password', 'password_confirm'],
        ];
    }

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            ['email', 'email'],
            [['lastname', 'firstname', 'patronimyc', 'post', 'email'], 'required'],
            [['password', 'password_confirm'], 'required', 'on' => self::SCENARIO_RESET_PASSWORD],
            ['password', 'string', 'min' => 8, 'on' => self::SCENARIO_RESET_PASSWORD],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают', 'on' => self::SCENARIO_RESET_PASSWORD],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lastname' => 'Фамилия',
            'firstname' => 'Имя',
            'patronimyc' => 'Отчество',
            'post' => 'Должность',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'mobilephone' => 'Мобильный телефон',
            'password' => 'Пароль',
            'password_confirm' => 'Пароль еще раз',
        ];
    }

    public function getFullname($short = false)
    {
        if ($short) {
            return $this->lastname . ' ' . mb_substr($this->firstname, 0, 1) . '. ' . mb_substr($this->patronimyc, 0, 1) . '.';
        } else {
            return $this->lastname . ' ' . $this->firstname . ' ' . $this->patronimyc;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id_user_author' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects0()
    {
        return $this->hasMany(Project::className(), ['id_user_service' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelationships()
    {
        return $this->hasMany(Relationship::className(), ['id_autor' => 'id']);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key == $authKey;
    }

    /**
     * 
     * @param int $id ID user
     * @return User
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * 
     * @param string $token
     * @param type $type
     * @return User
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['password_reset_token' => $token]);
    }

    /**
     * 
     * @param string $email
     * @return User
     */
    public static function findIdentityByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function resetPassword()
    {
        $this->setPassword($this->password);
        $this->generateAuthKey();
        $this->password_reset_token = null;
        return $this->save(false);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

}
