<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%opf}}".
 *
 * @property integer $id
 * @property string $short
 * @property string $name
 *
 * @property Contractor[] $contractors
 */
class Opf extends \yii\db\ActiveRecord
{
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
            'id' => 'ID',
            'short' => 'Сокращение',
            'name' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractors()
    {
        return $this->hasMany(Contractor::className(), ['id_opf' => 'id']);
    }
    
    public static function getList() {
        $list = self::find()->orderBy('name')->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
