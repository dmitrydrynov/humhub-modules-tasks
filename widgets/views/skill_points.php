<?php

use humhub\modules\tasks\models\Task;

/** @var $task Task **/
/** @var $includePending boolean **/
/** @var $includeCompleted boolean **/
/** @var $right boolean **/

?>

<div class="skill-points-block" data-toggle="tooltip" data-placement="bottom" title="Knowledge: <?= $knowledge_points ?> | Skills: <?= $skill_points ?>">
    <i class="fa fa-bolt"></i>&nbsp;<?= $knowledge_points + $skill_points ?>
</div>

<script>
    $(function () {
        $('.skill-points-block').tooltip()
    })
</script>