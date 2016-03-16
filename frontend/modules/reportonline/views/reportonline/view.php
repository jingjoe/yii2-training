<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\reportonline\models\Reportonline */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Reportonlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportonline-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'typename',
            'name',
            'details:ntext',
            //'image:ntext',
            [
            'format'=>'raw',
            'attribute'=>'image',
            'value'=>$model->getPhotosViewer()
            ],
           // 'files:ntext',
             ['attribute'=>'files','format'=>'html','value'=>!$model->files?'':Html::a('ดาวน์โหลด', ['/reportonline/reportonline/download','type'=>'files','id'=>$model->id])],
            'order_date',
            'defined_date',
            'unit',
            'linkname',
            'finish_date',
            'statusname',
            'create_date',
            'modify_date',
            'loginname',
            'updatename',
            //'token_upload',
        ],
    ]) ?>

</div>
