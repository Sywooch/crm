<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $site
 * @property string $site_test
 * @property integer $id_user
 * @property integer $id_status
 *
 * @property ProjectStatus $status
 * @property User $user
 * @property Contractor[] $Contractors
 */
class Project extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'site', 'id_user', 'id_status'], 'required'],
            [['id_user', 'id_status'], 'integer'],
            [['name', 'description', 'site', 'site_test'], 'string', 'max' => 255],
            [['site', 'site_test'], 'url', 'defaultScheme' => 'http'],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectStatus::className(), 'targetAttribute' => ['id_status' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
            'site' => 'Сайт',
            'site_test' => 'Тестовый сайт',
            'id_user' => 'Ответственный',
            'id_status' => 'Статус проекта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ProjectStatus::className(), ['id' => 'id_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractors()
    {
        return $this->hasMany(Contractor::className(), ['id' => 'id_contractor'])
                        ->viaTable('{{%lnk_project_contractor}}', ['id_project' => 'id']);
    }

    public function getStatusName()
    {
        return $this->status->name;
    }
    
    public static function getList() {
        $projects = self::find()->orderBy('name')->all();
        return ArrayHelper::map($projects, 'id', 'name');
    }

}
