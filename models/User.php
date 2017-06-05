<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $user_id
 * @property string $lastname
 * @property string $firstname
 * @property string $patronymic
 * @property string $post
 * @property string $email
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
    public $old_password;
    public $password;
    public $password_confirm;
    public $role;

    const SCENARIO_PROFILE = 'profile';
    const SCENARIO_RESET_PASSWORD = 'reset_password';
    const SCENARIO_CHANGE_PASSWORD = 'change_password';

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['firstname', 'lastname', 'patronymic', 'email', 'post', 'mobilephone', 'role'],
            self::SCENARIO_PROFILE => ['firstname', 'lastname', 'patronymic', 'mobilephone'],
            self::SCENARIO_RESET_PASSWORD => ['password', 'password_confirm'],
            self::SCENARIO_CHANGE_PASSWORD => ['old_password', 'password', 'password_confirm'],
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
            [['lastname', 'firstname', 'patronymic', 'post', 'email', 'role'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['lastname', 'firstname', 'patronymic'], 'required', 'on' => self::SCENARIO_PROFILE],
            ['old_password', 'required', 'on' => self::SCENARIO_CHANGE_PASSWORD],
            ['old_password', 'checkOldPassword', 'on' => self::SCENARIO_CHANGE_PASSWORD],
            [['password', 'password_confirm'], 'required', 'on' => [self::SCENARIO_CHANGE_PASSWORD, self::SCENARIO_RESET_PASSWORD]],
            ['password', 'string', 'min' => 8, 'on' => [self::SCENARIO_CHANGE_PASSWORD, self::SCENARIO_RESET_PASSWORD]],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают', 'on' => [self::SCENARIO_CHANGE_PASSWORD, self::SCENARIO_RESET_PASSWORD]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'lastname' => 'Фамилия',
            'firstname' => 'Имя',
            'patronymic' => 'Отчество',
            'post' => 'Должность',
            'email' => 'E-mail',
            'mobilephone' => 'Телефон',
            'old_password' => 'Старый пароль',
            'password' => 'Пароль',
            'password_confirm' => 'Пароль еще раз',
        ];
    }

    public function getFullname($short = false)
    {
        if ($short) {
            return $this->lastname . ' ' . mb_substr($this->firstname, 0, 1) . '. ' . mb_substr($this->patronymic, 0, 1) . '.';
        } else {
            return $this->lastname . ' ' . $this->firstname . ' ' . $this->patronymic;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id_user_author' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects0()
    {
        return $this->hasMany(Project::className(), ['id_user_service' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelationships()
    {
        return $this->hasMany(Relationship::className(), ['id_autor' => 'user_id']);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getId()
    {
        return $this->user_id;
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

    public function checkOldPassword($attribute, $params)
    {
        if (!Yii::$app->user->identity->validatePassword($this->$attribute)) {
            $this->addError($attribute, 'Старый пароль указан не верно');
        }
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        $authManager = Yii::$app->authManager;
        $authManager->revokeAll($this->user_id);
        foreach ($this->role as $role) {
            $r = $authManager->getRole($role);
            if ($r) {
                $authManager->assign($r, $this->user_id);
            }
        }
    }

    public function afterFind()
    {
        parent::afterFind();

        $authManager = Yii::$app->authManager;

        $roles = $authManager->getRolesByUser($this->user_id);
        foreach($roles as $key => $role) {
            $this->role[] = $key;
        }
                
    }

}
