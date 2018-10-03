<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $model \app\models\News */
/* @var $comment \app\models\Comment */
/* @var $dataProvider \yii\data\ActiveDataProvider */

?>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#new_comment").on("pjax:end", function() {
            $.pjax.reload({container:"#comments"});
        });
    });'
);
?>

<div class="news-view">

    <p><span class="label label-default"><?= $model->category->name ?></span></p>

    <h3>
        <?= Html::a($model->title, ['news/view', 'url' => $model->url]) ?>
        <small>
            <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
        </small>
    </h3>

    <p>
        <?= $model->text ?>
    </p>
</div>
<hr>

<div class="comments">

    <h4>Комментарии</h4>

    <div class="comment-form">
        <?php Pjax::begin(['id' => 'new_comment']) ?>
        <?php $form = ActiveForm::begin([
            'options' => ['data-pjax' => true],
        ]); ?>

        <?= $form->field($comment, 'text')->textarea(['rows' => 3]) ?>

        <div class="form-group">
            <?= Html::submitButton(
                'Добавить',
                ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>

    </div>

    <?php Pjax::begin(['id' => 'comments']) ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_comment',
        'summary' => false,
    ]); ?>
    <?php Pjax::end() ?>

</div>




