<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ประกาศข่าว', ['create'], ['class' => 'btn btn-success', 'title' => 'ประกาศข่าว',]) ?>
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span> เพิ่มหัวข้อข่าว', ['/categorynews/index'], ['class' => 'btn btn-danger', 'title' => 'เพิ่มหัวข้อข่าว',]) ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="pull-right">
                <form class="form-inline">
                    <div class="form-group">
                        
                </form>
            </div>
        </div>
    </div>
</div>
    <br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'catname',
            'title',
            //'detail:ntext',
            //'img:ntext',
            // 'token_upload', 
            'view',
            'status',
            // 'create_date',
            // 'modify_date',
            // 'created_by',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
