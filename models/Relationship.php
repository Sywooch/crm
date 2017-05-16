<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%relationship}}".
 *
 * @property integer $id
 * @property integer $id_contractor
 * @property integer $id_contact
 * @property integer $id_autor
 * @property string $title
 * @property string $description
 * @property integer $datetime
 *
 * @property Contractor $idContractor
 * @property Contact $idContact
 * @property User $idAutor
 */
class Relationship extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relationship}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_contractor', 'id_contact', 'id_autor', 'datetime'], 'integer'],
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['id_contractor'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['id_contractor' => 'id']],
            [['id_contact'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::className(), 'targetAttribute' => ['id_contact' => 'id']],
            [['id_autor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_autor' => 'id']],
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
            'id_contact' => 'Контакт',
            'id_autor' => 'Автор',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'datetime' => 'Дата и время',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContractor()
    {
        return $this->hasOne(Contractor::className(), ['id' => 'id_contractor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'id_contact']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAutor()
    {
        return $this->hasOne(User::className(), ['id' => 'id_autor']);
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        $relation = Yii::$app->request->get('relation');
        $relation_id = Yii::$app->request->get('relation_id');
        $field = 'id_' . $relation;
        $this->$field = $relation_id;
        $this->id_autor = Yii::$app->user->getId();
        $this->datetime = time();
        return true;
    }
    
    public function afterFind()
    {
        parent::afterFind();
        $this->datetime = Yii::$app->formatter->asDatetime($this->datetime);
    }

}
