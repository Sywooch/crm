<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property integer $project_id
 * @property string $name
 * @property string $description
 * @property string $site
 * @property string $site_test
 * @property integer $user_id
 * @property integer $project_status_id
 *
 * @property ProjectStatus $status
 * @property User $user
 * @property Contractor[] $Contractors
 */
class Project extends \yii\db\ActiveRecord
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
        return '{{%project}}';
    }

    public function rules()
    {
        return [
            [['name', 'user_id', 'project_status_id'], 'required'],
            [['user_id', 'project_status_id'], 'integer'],
            [['name', 'description', 'site', 'site_test'], 'string', 'max' => 255],
            [['site', 'site_test'], 'url', 'defaultScheme' => 'http'],
            ['project_status_id', 'exist', 'targetClass' => ProjectStatus::className()],
            ['user_id', 'exist', 'targetClass' => User::className()]
        ];
    }

    public function attributeLabels()
    {
        return [
            'project_id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
            'site' => 'Сайт',
            'site_test' => 'Тестовый сайт',
            'user_id' => 'Ответственный',
            'project_status_id' => 'Статус проекта',
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(ProjectStatus::className(), ['project_status_id' => 'project_status_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    public function getContractors()
    {
        return $this->hasMany(Contractor::className(), ['contractor_id' => 'contractor_id'])
                        ->viaTable('{{%lnk_project_contractor}}', ['project_id' => 'project_id']);
    }

    public function getStatusName()
    {
        return $this->status->name;
    }

    public static function getList()
    {
        $projects = self::find()->orderBy('name')->all();
        return ArrayHelper::map($projects, 'project_id', 'name');
    }

    public function getLabelBreadcrumbs()
    {
        return $this->name;
    }

}
