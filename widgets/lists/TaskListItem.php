<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 */

namespace humhub\modules\tasks\widgets\lists;


use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\tasks\helpers\TaskListUrl;
use humhub\modules\tasks\models\Task;
use humhub\modules\tasks\permissions\ManageTasks;
use humhub\modules\tasks\permissions\CloneTask;
use humhub\widgets\JsWidget;
use Yii;

class TaskListItem extends JsWidget
{
    /**
     * @var Task
     */
    public $task;

    /**
     * @inheritdoc
     */
    public $jsWidget = 'task.list.Task';

    /**
     * @inheritdoc
     */
    public $init = true;

    /**
     * @var ContentContainerActiveRecord
     */
    private $contentContainer;

    /**
     * @var bool wheather or not to eager load the detail view
     */
    public $details = false;

    /**
     * @var bool
     */
    public $canManage = false;

    public $canClone = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->contentContainer = Yii::$app->controller->contentContainer;
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->canManage =  $this->contentContainer->can(ManageTasks::class);
        $this->canClone =  $this->contentContainer->can(CloneTask::class);
        return $this->render('taskListItem', [
            'task' => $this->task,
            'details' => $this->details,
            'canManage' => $this->canManage,
            'canClone' => $this->canClone,
            'options' => $this->getOptions()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return [
            'class' => 'task-list-item'
        ];
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        return [
            'task-id' =>  $this->task->id,
            'content-id' =>  $this->task->content->id,
            'reload-url' => TaskListUrl::reloadTaskListTask($this->task),
            'load-details-url' =>  TaskListUrl::loadTaskDetails($this->task),
            'task-status' => $this->task->status
        ];
    }
}