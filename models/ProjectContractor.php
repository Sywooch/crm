<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%project_contractor}}".
 *
 * @property integer $id_project
 * @property integer $id_contractor
 *
 * @property Project $idProject
 * @property Contractor $idContractor
 */
class ProjectContractor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lnk_project_contractor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_project', 'id_contractor'], 'required'],
            [['id_project', 'id_contractor'], 'integer'],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['id_project' => 'id']],
            [['id_contractor'], 'exist', 'skipOnError' => true, 'targetClass' => Contractor::className(), 'targetAttribute' => ['id_contractor' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_project' => 'Проект',
            'id_contractor' => 'Контрагент',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'id_project']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContractor()
    {
        return $this->hasOne(Contractor::className(), ['id' => 'id_contractor']);
    }
}
