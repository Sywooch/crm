<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%opf}}".
 *
 * @property integer $opf_id
 * @property string $short
 * @property string $name
 *
 * @property Contractor[] $contractors
 */
class Opf extends \yii\db\ActiveRecord
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
        return '{{%opf}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short', 'name'], 'required'],
            [['short', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'opf_id' => 'ID',
            'short' => 'Сокращение',
            'name' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractors()
    {
        return $this->hasMany(Contractor::className(), ['opf_id' => 'opf_id']);
    }

    public static function getList()
    {
        $list = self::find()->orderBy('name')->all();
        return ArrayHelper::map($list, 'opf_id', 'name');
    }

}
