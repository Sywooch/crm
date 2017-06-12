<?php

use yii\db\Migration;

class m170612_110058_create_table_trade extends Migration
{
    private $tradeStatusTable = '{{%trade_status}}';
    private $tradeTable = '{{%trade}}';
    private $contractorTable = '{{%contractor}}';

    
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tradeStatusTable, [
            'trade_status_id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string()->notNull()->comment('Наименование'),
                ], $tableOptions . "  COMMENT='Статусы сделок'");

        $this->createTable($this->tradeTable, [
            'trade_id' => $this->primaryKey()->comment('ID'),
            'contractor_id' => $this->integer()->notNull()->comment('Контрагент'),
            'trade_status_id' => $this->integer()->notNull()->comment('Статус'),
            'name' => $this->string()->notNull()->comment('Наименование'),
            'price' => $this->float()->notNull()->comment('Цена'),
            'start' => $this->integer()->notNull()->comment('Дата начала'),
            'end' => $this->integer()->notNull()->comment('Дата окончания'),
                ], $tableOptions . "  COMMENT='Сделки'");
        $this->createIndex('idx-trade-contractor_id', $this->tradeTable, 'contractor_id');
        $this->createIndex('idx-trade-trade_status_id', $this->tradeTable, 'trade_status_id');
        
        $this->addForeignKey('fk-contractor-trade', $this->tradeTable, 'contractor_id', $this->contractorTable, 'contractor_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-trade_status-trade', $this->tradeTable, 'trade_status_id', $this->tradeStatusTable, 'trade_status_id', 'RESTRICT', 'CASCADE');
        
    }

    public function down()
    {
        $this->dropForeignKey('fk-trade_status-trade', $this->tradeTable);
        $this->dropForeignKey('fk-contractor-trade', $this->tradeTable);
        
        $this->dropTable($this->tradeTable);
        $this->dropTable($this->tradeStatusTable);
    }

}
