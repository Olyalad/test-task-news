<?php

use yii\helpers\Html;

/* @var $model \app\models\Comment */
?>

<p>
    <?= $model->text ?>
    <small class="text-muted"> -
        <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
    </small>
</p>