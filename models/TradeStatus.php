<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%trade_status}}".
 *
 * @property integer $trade_status_id
 * @property string $name
 *
 * @property Trade[] $trades
 */
class TradeStatus extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%trade_status}}';
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'trade_status_id' => 'ID',
            'name' => 'Наименование',
        ];
    }

    public function getTrades()
    {
        return $this->hasMany(Trade::className(), ['trade_status_id' => 'trade_status_id']);
    }
    
    public static function getList()
    {
        $data = self::find()->orderBy('name')->all();
        return ArrayHelper::map($data, 'trade_status_id', 'name');
    }

}
