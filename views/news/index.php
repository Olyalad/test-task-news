<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $categories \app\models\Category[] */


$this->title = 'Новости';
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <?php
            foreach ($categories as $category) {
                echo Html::a(str_repeat(' ', $category->level * 4) . $category->name, ['news/index', 'category' => $category->id]);
                echo '<br>';
            }
            ?>
        </div>
        <div class="col-md-9">
            <?php Pjax::begin(); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_news',
                'pager' => [
                    'firstPageLabel' => '&laquo;&laquo;',
                    'lastPageLabel' => '&raquo;&raquo;',
                ],
            ])
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
