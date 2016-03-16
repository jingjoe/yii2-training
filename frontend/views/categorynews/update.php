<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CategoryNews */

$this->title = 'Update Category News: ' . ' ' . $model->cat_id;
$this->params['breadcrumbs'][] = ['label' => 'Category News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cat_id, 'url' => ['view', 'id' => $model->cat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
