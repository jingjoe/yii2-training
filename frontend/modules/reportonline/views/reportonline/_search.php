<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\reportonline\models\ReportonlineSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reportonline-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reporttype_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'details') ?>

    <?= $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'files') ?>

    <?php // echo $form->field($model, 'order_date') ?>

    <?php // echo $form->field($model, 'defined_date') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'link_id') ?>

    <?php // echo $form->field($model, 'finish_date') ?>

    <?php // echo $form->field($model, 'report_status_id') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'modify_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'token_upload') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
