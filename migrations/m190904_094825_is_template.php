<?php

use yii\db\Migration;

/**
 * Class m190904_094825_is_template
 */
class m190904_094825_is_template extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'is_template', 'tinyint(4) NOT NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190904_094825_is_template cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190904_094825_is_template cannot be reverted.\n";

        return false;
    }
    */
}
