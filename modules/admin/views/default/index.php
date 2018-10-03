<?php

use yii\helpers\Html;

$this->title = 'Администрирование';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-default-index">
    <p>
        <?= Html::a(
            'Новости',
            ['news/index'],
            ['class' => 'btn btn-primary']) ?>
    </p>
    <p>
        <?= Html::a(
            'Категории',
            ['category/index'],
            ['class' => 'btn btn-primary']) ?>

    </p>

</div>
