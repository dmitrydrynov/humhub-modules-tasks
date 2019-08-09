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
        $knowledge_points = 0;

        if(class_exists(\humhub\modules\aJournal\models\aJournalEntry::class)) {
            $knowledge_points = \humhub\modules\aJournal\models\aJournalEntry::getAcademicMarksbyUser();
        }

        return $this->render('skill_points', [
            'skill_points' => $skill_points,
            'knowledge_points' => $knowledge_points ? $knowledge_points * 2 : 0,
        ]);
    }
}