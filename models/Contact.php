<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property integer $id
 * @property integer $id_contractor
 * @property string $lastname
 * @property string $firstname
 * @property string $patronimyc
 * @property string $post
 * @property string $email
 * @property string $phone
 * @property string $description
 *
 * @property Contractor $contractor
 * @property Relationship[] $relationships
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_contractor', 'lastname', 'firstname', 'phone'], 'required'],
            [['id_contractor'], 'integer'],
            [['lastname', 'firstname', 'patronimyc', 'post', 'email', 'description'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['id_contractor'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['id_contractor' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_contractor' => 'Контрагент',
            'lastname' => 'Фамилия',
            'firstname' => 'Имя',
            'patronimyc' => 'Отчество',
            'post' => 'Должность',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractor()
    {
        return $this->hasOne(Contractor::className(), ['id' => 'id_contractor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelationships()
    {
        return $this->hasMany(Relationship::className(), ['id_contact' => 'id']);
    }
    
    public function getFullName($short = false)
    {
        $fullname = $this->lastname;
        if ($short) {
            $fullname .= ' ' . mb_substr($this->firstname, 0, 1) . '. ' . mb_substr($this->patronimyc, 0, 1) . '.';
        } else {
            $fullname .= ' ' . $this->firstname . ' ' . $this->patronimyc;
        }
        
        return $fullname;
    }
    
    public function getLabelBreadcrumbs() {
        return $this->getFullName(true);
    }
}
