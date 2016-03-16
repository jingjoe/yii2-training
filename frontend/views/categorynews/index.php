<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category News';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['/news/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'cat_id',
            'cat_name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
