<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Personal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cid',
            'pname',
            'fname',
            'lname',
            // 'sex',
            // 'age',
            // 'religion_id',
            // 'bloodgroup',
            // 'marrystatus_id',
            // 'birthdate',
            // 'address:ntext',
            // 'province_id',
            // 'amphur_id',
            // 'district_id',
            // 'zip_code',
            // 'lat',
            // 'lng',
            // 'phone',
            // 'email:email',
            // 'skill:ntext',
            // 'education_id',
            // 'token_upload',
            // 'img:ntext',
            // 'startwork_date',
            // 'position_id',
            // 'salary',
            // 'group_id',
            // 'depart_id',
            // 'persontype_id',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
