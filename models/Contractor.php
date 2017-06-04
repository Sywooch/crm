<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%contractor}}".
 *
 * @property integer $contractor_id
 * @property integer $opf_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $fax
 * @property string $legal_country
 * @property string $legal_region
 * @property string $legal_city
 * @property string $legal_street
 * @property string $legal_house
 * @property integer $legal_postcode
 * @property string $mailing_country
 * @property string $mailing_region
 * @property string $mailing_city
 * @property string $mailing_street
 * @property string $mailing_house
 * @property integer $mailing_postcode
 * @property string $bank
 * @property string $bik
 * @property string $rs
 * @property string $ks
 * @property string $ogrn
 * @property string $kpp
 * @property string $inn
 *
 * @property Opf $opf
 * @property Contact[] $contacts
 * @property Document[] $documents
 * @property Project[] $projects
 * @property Relationship[] $relationships
 */
class Contractor extends \yii\db\ActiveRecord
{
    public $projects;

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
        return '{{%contractor}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['opf_id', 'name', 'email', 'phone', 'legal_region', 'legal_city', 'legal_street', 'legal_house', 'legal_postcode', 'mailing_region', 'mailing_city', 'mailing_street', 'mailing_house', 'mailing_postcode'], 'required'],
            [['opf_id', 'legal_postcode', 'mailing_postcode'], 'integer'],
            [['name', 'email', 'legal_country', 'legal_region', 'legal_city', 'legal_street', 'legal_house', 'mailing_country', 'mailing_region', 'mailing_city', 'mailing_street', 'mailing_house', 'bank'], 'string', 'max' => 255],
            [['phone', 'fax'], 'string', 'max' => 20],
            ['projects', 'safe'],
            ['projects', 'required'],
            [['bik', 'rs', 'ks', 'ogrn', 'kpp', 'inn'], 'string', 'max' => 100],
            [['opf_id'], 'exist', 'skipOnError' => true, 'targetClass' => Opf::className(), 'targetAttribute' => ['opf_id' => 'opf_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contractor_id' => 'ID',
            'opf_id' => 'ОПФ',
            'name' => 'Наименование',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'fax' => 'Факс',
            'legal_country' => 'Страна',
            'legal_region' => 'Регион',
            'legal_city' => 'Город',
            'legal_street' => 'Улица',
            'legal_house' => 'Дом',
            'legal_postcode' => 'Индекс',
            'mailing_country' => 'Страна',
            'mailing_region' => 'Регион',
            'mailing_city' => 'Город',
            'mailing_street' => 'Улица',
            'mailing_house' => 'Дом',
            'mailing_postcode' => 'Индекс',
            'bank' => 'Банк',
            'bik' => 'БИК',
            'rs' => 'Р/С',
            'ks' => 'К/С',
            'ogrn' => 'ОГРН',
            'kpp' => 'КПП',
            'inn' => 'ИНН',
            'projects' => 'Проекты',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpf()
    {
        return $this->hasOne(Opf::className(), ['opf_id' => 'opf_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['contractor_id' => 'contractor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['contractor_id' => 'contractor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['project_id' => 'project_id'])
                        ->viaTable('{{%lnk_project_contractor}}', ['contractor_id' => 'contractor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelationships()
    {
        return $this->hasMany(Relationship::className(), ['contractor_id' => 'contractor_id']);
    }

    public static function getList()
    {
        $data = self::find()
                ->orderBy('name')
                ->all();
        return ArrayHelper::map($data, 'contractor_id', 'name');
    }

    public function getLabelBreadcrumbs()
    {
        return $this->name;
    }

    public function getOpfName()
    {
        return $this->opf->short;
    }

    public function afterFind()
    {
        // загрузка списка проектов в поле Проекты
        parent::afterFind();
        if ($this->contractor_id) {
            $rows = ProjectContractor::find()
                    ->select(['project_id'])
                    ->where(['contractor_id' => $this->contractor_id])
                    ->asArray()
                    ->all();
            foreach ($rows as $row) {
                $this->projects[] = $row['project_id'];
            }
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // обновляем список проектов для контрагента
        // удаляем старый
        $this->unlinkAll('projects', true);
        // сохраняем новый список, если он не пустой
        if ($this->projects) {
            foreach ($this->projects as $project) {
                $object = Project::findOne($project);
                $this->link('projects', $object);
            }
        }
    }

}
