<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%trade}}".
 *
 * @property integer $trade_id
 * @property integer $contractor_id
 * @property integer $trade_status_id
 * @property string $name
 * @property double $price
 * @property integer $start
 * @property integer $end
 *
 * @property Contractor $contractor
 * @property TradeStatus $tradeStatus
 */
class Trade extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%trade}}';
    }

    public function rules()
    {
        return [
            [['contractor_id', 'trade_status_id', 'name', 'price', 'start', 'end'], 'required'],
            [['contractor_id', 'trade_status_id'], 'integer'],
            ['start', 'date', 'timestampAttribute' => 'start'],
            ['end', 'date', 'timestampAttribute' => 'end'],
            ['name', 'string', 'max' => 255],
            ['contractor_id', 'exist', 'targetClass' => Contractor::className()],
            ['trade_status_id', 'exist', 'targetClass' => TradeStatus::className()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'trade_id' => 'ID',
            'contractor_id' => 'Контрагент',
            'trade_status_id' => 'Статус',
            'name' => 'Наименование',
            'price' => 'Цена',
            'start' => 'Дата начала',
            'end' => 'Дата окончания',
        ];
    }

    public function getContractor()
    {
        return $this->hasOne(Contractor::className(), ['contractor_id' => 'contractor_id']);
    }

    public function getTradeStatus()
    {
        return $this->hasOne(TradeStatus::className(), ['trade_status_id' => 'trade_status_id']);
    }

    public function getStatusName()
    {
        return $this->tradeStatus->name;
    }

    public function afterFind()
    {
        $this->start = $this->start ? Yii::$app->formatter->asDate($this->start) : '';
        $this->end = $this->end ? Yii::$app->formatter->asDate($this->end) : '';
        parent::afterFind();
    }

    public function getContractorName()
    {
        return $this->contractor->name;
    }

}
