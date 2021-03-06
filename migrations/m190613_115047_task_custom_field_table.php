<?php

use yii\db\Migration;

/**
 * Class m190613_115047_task_custom_field_table
 */
class m190613_115047_task_custom_field_table extends Migration
{
    public function up()
    {
        $this->createTable('task_custom_field', array(
            'id' => 'pk',
            'internal_name' => 'varchar(190) NOT NULL',
            'title' => 'varchar(190) NOT NULL',
            'type' => 'varchar(190) NOT NULL',
            'value' => 'varchar(190)',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(11) NOT NULL',
            'updated_at' => 'datetime NOT NULL',
            'updated_by' => 'int(11) NOT NULL'
                ), '');
    }

    public function down()
    {
        echo "m190613_115047_task_custom_field_table does not support migration down.\n";
        return false;
    }
}
