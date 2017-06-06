<?php

use yii\db\Migration;

class m170606_165446_alter_table_project extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%project}}', 'site', "string NULL DEFAULT NULL COMMENT 'Сайт'");
    }

    public function down()
    {
        $this->alterColumn('{{%project}}', 'site', "string NOT NULL COMMENT 'Сайт'");
    }
}
