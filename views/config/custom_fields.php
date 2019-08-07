<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 */
/* @var $this yii\web\View */
/* @var $model \humhub\modules\tasks\models\CustomFieldsSettings */

use yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\tasks\helpers\TaskUrl;
?>

<div class="panel panel-default">

    <div class="panel-heading"><?= Yii::t('TasksModule.config', '<strong>Task</strong> module configuration'); ?></div>

    <?= $subNav ?>

    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

            <h4><?= Yii::t('TasksModule.config', 'Add new custom field'); ?></h4>

            <?= $form->field($model, 'title')->input('text') ?>
            <?= $form->field($model, 'internal_name')->input('text') ?>
            
            <?= $form->field($model, 'type')->dropDownList([
                'number' => 'Number',
                'text' => 'Text',
            ]); ?>
            
            <?= $form->field($model, 'value')->input('text') ?>

            <?= Html::submitButton('Add Field', ['class' => 'btn btn-primary', 'data-ui-loader' => '']) ?>

        <?php ActiveForm::end(); ?>

        <br><br>

        <h4>
            <?= Yii::t('TasksModule.config', 'Custom fields List'); ?>
        </h4>

        <table class="table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Тип данных</th>
                    <th>Значение по умолчанию</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($fields_list) > 0) : ?>
                    <?php foreach($fields_list as $field) : ?>
                        <tr>
                            <td>
                                <?= $field->title ?>
                            </td>
                            <td>
                                <?= $field->internal_name ?>
                            </td>
                            <td>
                                <?= $field->type ?>
                            </td>
                            <td>
                                <?= $field->value ?>
                            </td>
                            <td>
                                <a href="<?= Url::to(['/tasks/config/custom-fields', 'id' => $field->id, 'action' => 'delete']) ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan=5>No any custom fields</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>


    </div>
</div>