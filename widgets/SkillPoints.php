<?php

namespace humhub\modules\tasks\widgets;

use humhub\components\Widget;
use humhub\modules\tasks\models\Task;
use humhub\modules\tasks\models\SnippetModuleSettings;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\tasks\models\CustomFieldsSettings;

class SkillPoints extends Widget
{
    public function run()
    {

        $skill_points = Task::gerSumCustomFieldsByUser('skill_points');

        return $this->render('skillPoints', [
            'skillPoints' => $skill_points,
        ]);
    }
}