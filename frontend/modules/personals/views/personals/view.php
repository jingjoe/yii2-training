<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
/* @var $this yii\web\View */
/* @var $model frontend\models\Personal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Personals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-view">

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
    <div class="jumbotron">
        <h3>GIS Personal</h3>
        <p> แสดงแผนที่อยู่ของบุคลากร</p>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cid',
            'pname',
            'fname',
            'lname',
            'sex',
            'age',
            'religion_id',
            'bloodgroup',
            'marrystatus_id',
            'birthdate',
            'address:ntext',
            'province_id',
            'amphur_id',
            'district_id',
            'zip_code',
            'lat',
            'lng',
            'phone',
            'email:email',
            'skill:ntext',
            'education_id',
            'token_upload',
            'img:ntext',
            'startwork_date',
            'position_id',
            'salary',
            'group_id',
            'depart_id',
            'persontype_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
