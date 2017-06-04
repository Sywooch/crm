<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property integer $document_id
 * @property integer $project_id
 * @property integer $contractor_id
 * @property integer $contact_id
 * @property integer $folder_id
 * @property integer $document_type_id
 * @property string $name
 * @property string $description
 * @property string $filename
 *
 * @property Project $project
 * @property Contractor $contractor
 * @property Contact $contact
 * @property Folder $folder
 * @property DocumentType $documentType
 */
class Document extends \yii\db\ActiveRecord
{
    const PATH_TO_FILE = 'upload/documents/';

    /**
     * @var UploadedFile
     */
    public $file;

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
        return '{{%document}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_type_id', 'name', 'description', 'filename'], 'required'],
            [['project_id', 'contractor_id', 'contact_id', 'folder_id', 'document_type_id'], 'integer'],
            [['name', 'description', 'filename'], 'string', 'max' => 255],
            ['file', 'file', 'skipOnEmpty' => true],
            ['file', 'validateFile'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
            [['contractor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['contractor_id' => 'contractor_id']],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::className(), 'targetAttribute' => ['contact_id' => 'contact_id']],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['folder_id' => 'folder_id']],
            [['document_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentType::className(), 'targetAttribute' => ['document_type_id' => 'document_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'document_id' => 'ID',
            'project_id' => 'Проект',
            'contractor_id' => 'Контрагент',
            'contact_id' => 'Контакт',
            'folder_id' => 'Папка',
            'document_type_id' => 'Тип документа',
            'name' => 'Имя файла',
            'description' => 'Описание',
            'filename' => 'Файл',
            'file' => 'Файл',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Contractor::className(), ['project_id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractor()
    {
        return $this->hasOne(Contractor::className(), ['contractor_id' => 'contractor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contractor::className(), ['contact_id' => 'coontact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        return $this->hasOne(Folder::className(), ['folder_id' => 'folder_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['document_type_id' => 'document_type_id']);
    }

    public function upload()
    {
        $filename = $this->file->baseName . '.' . $this->file->extension;
        $this->filename = $filename;

        if ($this->validate() && $this->file->saveAs(self::PATH_TO_FILE . $filename)) {
            return true;
        }

        return false;
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        $relation = Yii::$app->request->get('relation');
        $relation_id = Yii::$app->request->get('relation_id');
        $field = $relation . '_id';
        $this->$field = $relation_id;
        return true;
    }

    public function beforeDelete()
    {
        parent::beforeDelete();
        if (!unlink(self::PATH_TO_FILE . $this->filename)) {
            return false;
        }

        return true;
    }

    public function getProjectName()
    {
        return $this->project->name;
    }

    public function getContractorName()
    {
        return $this->contractor->name;
    }

    public function getContactName()
    {
        return $this->contact->getFullName();
    }

    public function getDocumentTypeName()
    {
        return $this->documentType->name;
    }

    public function validateFile($attribute, $params)
    {
        if ($this->isNewRecord && empty($this->$attribute)) {
            $this->addError($attribute, 'Файл не выбран');
        }
    }

}
