<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\tasks\widgets;

use Yii;
use yii\helpers\Url;
use humhub\modules\tasks\helpers\TaskUrl;

/**
 * User Administration Menu
 *
 * @author Basti
 */
class AdminMenu extends \humhub\widgets\BaseMenu
{

    public $template = "@humhub/widgets/views/tabMenu";
    public $type = "adminTasksSubNavigation";

    public function init()
    {        
        $this->addItem([
            'label' => Yii::t('TasksModule.base', 'Configuration'),
            'url' => TaskUrl::toConfig(),
            'sortOrder' => 200,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'tasks' 
                    && Yii::$app->controller->action->id == 'index'),
        ]);

        $this->addItem([
            'label' => Yii::t('TasksModule.base', 'Custom Fields'),
            'url' => TaskUrl::toConfigCustomFields(),
            'sortOrder' => 200,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'tasks' 
                    && Yii::$app->controller->action->id == 'custom-fields'),
        ]);
        
        parent::init();
    }

}
