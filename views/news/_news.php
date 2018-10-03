<?php

use yii\helpers\Html;

/* @var $model \app\models\News */
?>

<h3>
    <?= Html::a($model->title, ['news/view', 'url' => $model->url], ['data-pjax' => 0]) ?>
    <small>
        <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
    </small>
</h3>

<p>
    <?= $model->preview ?>
</p>