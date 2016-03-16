<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\reportonline\models\Reportonline */

$this->title = 'Update Reportonline: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Reportonlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reportonline-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
