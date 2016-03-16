<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CategoryNews */

$this->title = 'Create Category News';
$this->params['breadcrumbs'][] = ['label' => 'Category News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
