<?php

namespace app\models;

use Yii;
use app\models\Contact;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%authority_basis}}".
 *
 * @property integer $authority_basis_id
 * @property string $name
 * @property string $genitive
 * @property integer $created_at
 * @property integer $updated_at
 * 
 * @property Contact[] Contacts
 */
class AuthorityBasis extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%authority_basis}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'genitive'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'genitive'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'authority_basis_id' => 'ID',
            'name' => 'Наименование',
            'genitive' => 'Родительный падеж',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['authority_basis_id' => 'authority_basis_id']);
    }

    public static function getList()
    {
        $data = self::find()->orderBy('name')->all();
        return ArrayHelper::map($data, 'authority_basis_id', 'name');
    }

}
