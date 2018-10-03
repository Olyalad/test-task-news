<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $categoryList array */

$this->title = 'Добавление категории';
$this->params['breadcrumbs'][] = ['url' => ['/admin'], 'label' => 'Администрирование'];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList,
    ]) ?>

</div>
