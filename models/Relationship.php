<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%relationship}}".
 *
 * @property integer $relationship_id
 * @property integer $contractor_id
 * @property integer $contact_id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property integer $created_at
 *
 * @property Contractor $contractor
 * @property Contact $contact
 * @property User $user
 */
class Relationship extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

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
            [['contractor_id', 'contact_id', 'user_id', 'created_at'], 'integer'],
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['contractor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['contractor_id' => 'contractor_id']],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::className(), 'targetAttribute' => ['contact_id' => 'contact_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'relationship_id' => 'ID',
            'contractor_id' => 'Контрагент',
            'contact_id' => 'Контакт',
            'user_id' => 'Автор',
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
        return $this->hasOne(Contractor::className(), ['contractor_id' => 'contractor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContact()
    {
        return $this->hasOne(Contact::className(), ['contact_id' => 'contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAutor()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        $relation = Yii::$app->request->get('relation');
        $relation_id = Yii::$app->request->get('relation_id');
        $field = $relation . '_id';
        $this->$field = $relation_id;
        $this->user_id = Yii::$app->user->getId();
        return true;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->created_at = Yii::$app->formatter->asDatetime($this->created_at);
    }

}
