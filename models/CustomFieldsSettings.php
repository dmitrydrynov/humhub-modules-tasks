<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 */

namespace humhub\modules\tasks\models;

use Yii;
use \yii\base\Model;
use humhub\components\ActiveRecord;
use humhub\modules\tasks\models\Task;

class CustomFieldsSettings extends ActiveRecord
{   
    public static function tableName()
    {
        return 'task_custom_field';
    }

    public function rules()
    {
        return [
            [['title','internal_name', 'type'], 'required'],
            ['internal_name', 'unique'],
            [['value'], 'safe'], 
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            
            if($this->type == 'number') {
                $this->value = (int)$this->value;
            }

            if($this->type == 'text') {
                $this->value = (string)$this->value;
            }

            $this->value = empty($this->value) ? null : $this->value;
            
            return true;
        } else {
            return false;
        }            
    }

    public function afterSave($insert, $changedAttributes)
    {        
        $column_name = 'cf_'. $this->internal_name;

        if (!self::columnExists($column_name)) {

            if($this->type == 'number') {
                $query = Yii::$app->db->getQueryBuilder()->addColumn(Task::tableName(), $column_name, 'INT(11)');
                Yii::$app->db->createCommand($query)->execute();
                Yii::$app->db->createCommand("update ". Task::tableName() ." set ". $column_name ." = ". ($this->value ? $this->value : 'null'))->execute();
            }

            if($this->type == 'text') {
                $query = Yii::$app->db->getQueryBuilder()->addColumn(Task::tableName(), $column_name, 'VARCHAR(255)');
                Yii::$app->db->createCommand($query)->execute();
                Yii::$app->db->createCommand("update ". Task::tableName() ." set ". $column_name ." = '". $this->value ."'")->execute();
            }
                        
        }

        parent::afterSave($insert, $changedAttributes);
    }


    public function delete()
    {
        $column_name = 'cf_'. $this->internal_name;
        if (self::columnExists($column_name)) {
            $query = Yii::$app->db->getQueryBuilder()->dropColumn(Task::tableName(), $column_name);
            Yii::$app->db->createCommand($query)->execute();
        }

        // dd($query);

        parent::delete();
    }

    // public function delete()
    // {
    //     // Delete the birthdate_hide_year field
    //     $columnNameHideYear = $this->profileField->internal_name . '_hide_year';
    //     if (Profile::columnExists($columnNameHideYear)) {
    //         $query = Yii::$app->db->getQueryBuilder()->dropColumn(Profile::tableName(), $columnNameHideYear);
    //         Yii::$app->db->createCommand($query)->execute();
    //     }

    //     // Delete the birthdate field (this is done by parent implementation)
    //     return parent::delete();
    // }


    protected static function columnExists($name)
    {
        Yii::$app->getDb()->getSchema()->refreshTableSchema(Task::tableName());
        $table = Yii::$app->getDb()->getSchema()->getTableSchema(Task::tableName(), true);
        $columnNames = $table->getColumnNames();

        return (in_array($name, $columnNames));
    }

}
