<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\reportonline\models\Reportonline */

$this->title = 'Create Reportonline';
$this->params['breadcrumbs'][] = ['label' => 'Reportonlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportonline-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
