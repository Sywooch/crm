<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property integer $id
 * @property integer $id_contractor
 * @property integer $id_folder
 * @property integer $id_type
 * @property string $name
 * @property string $description
 * @property string $file
 *
 * @property Contractor $idContractor
 * @property Folder $idFolder
 * @property DocumentType $idType
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%document}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_contractor', 'id_type', 'name', 'description', 'file'], 'required'],
            [['id_contractor', 'id_folder', 'id_type'], 'integer'],
            [['name', 'description', 'file'], 'string', 'max' => 255],
            [['id_contractor'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['id_contractor' => 'id']],
            [['id_folder'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['id_folder' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::className(), 'targetAttribute' => ['id_type' => 'id']],
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
            'id_folder' => 'Папка',
            'id_type' => 'Тип документа',
            'name' => 'Имя файла',
            'description' => 'Описание',
            'file' => 'Файл',
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
    public function getIdFolder()
    {
        return $this->hasOne(Folder::className(), ['id' => 'id_folder']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'id_type']);
    }
}
