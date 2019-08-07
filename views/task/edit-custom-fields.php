<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 */

use humhub\modules\file\widgets\Upload;


/* @var $form \humhub\widgets\ActiveForm */
/* @var $taskForm \humhub\modules\calendar\models\forms\CalendarEntryForm */
/* @var $taskForm \humhub\modules\tasks\models\forms\TaskForm */

$custom_fields = $taskForm->task->getCustomFields();
?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">

            <?php foreach($custom_fields as $custom_field) : ?>
                <?php if($custom_field->type == 'text') : ?>
                    <?= $form->field($taskForm->task, 'cf_'. $custom_field->internal_name)->textInput()->label($custom_field->title); ?> 
                <?php endif ?>   
                <?php if($custom_field->type == 'number') : ?>
                    <?= $form->field($taskForm->task, 'cf_'. $custom_field->internal_name)->input('number')->label($custom_field->title); ?> 
                <?php endif ?>    
            <?php endforeach ?>

        </div>       
    </div>
</div>