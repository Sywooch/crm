<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property integer $contact_id
 * @property integer $contractor_id
 * @property string $lastname
 * @property string $firstname
 * @property string $patronymic
 * @property string $authority_basis_id
 * @property string $post
 * @property string $email
 * @property string $phone
 * @property string $description
 *
 * @property Contractor $contractor
 * @property Relationship[] $relationships
 * @property AuthorityBasis $authorityBasis
 */
class Contact extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    public static function tableName()
    {
        return '{{%contact}}';
    }
    
    public function rules()
    {
        return [
            [['contractor_id', 'lastname', 'firstname', 'email', 'phone'], 'required'],
            [['contractor_id'], 'integer'],
            [['lastname', 'firstname', 'patronymic', 'post', 'email', 'description'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            ['contractor_id', 'exist', 'targetClass' => Contractor::className()],
            ['authority_basis_id', 'exist', 'targetClass' => AuthorityBasis::className()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'contact_id' => 'ID',
            'contractor_id' => 'Контрагент',
            'lastname' => 'Фамилия',
            'firstname' => 'Имя',
            'patronymic' => 'Отчество',
            'post' => 'Должность',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'description' => 'Описание',
            'authority_basis_id' => 'Основание полномочий',
        ];
    }

    public function getContractor()
    {
        return $this->hasOne(Contractor::className(), ['contractor_id' => 'contractor_id']);
    }
    
    public function getAuthorityBasis() {
        return $this->hasOne(AuthorityBasis::className(), ['authority_basis_id' => 'authority_basis_id']);
    }

    public function getRelationships()
    {
        return $this->hasMany(Relationship::className(), ['contact_id' => 'contact_id']);
    }

    public function getFullName($short = false)
    {
        $fullname = $this->lastname;
        if ($short) {
            $fullname .= ' ' . mb_substr($this->firstname, 0, 1) . '. ' . mb_substr($this->patronymic, 0, 1) . '.';
        } else {
            $fullname .= ' ' . $this->firstname . ' ' . $this->patronymic;
        }

        return $fullname;
    }

    public function getLabelBreadcrumbs()
    {
        return $this->getFullName(true);
    }

    public function getContractorName()
    {
        return $this->contractor->name;
    }

}
