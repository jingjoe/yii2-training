<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\VarDumper;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
// ลิงค์โมดูล dropdownlist
use frontend\modules\reportonline\models\Link;
use frontend\modules\reportonline\models\ReportStatus;
use frontend\modules\reportonline\models\ReportType;

/* @var $this yii\web\View */
/* @var $model frontend\modules\reportonline\models\Reportonline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reportonline-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?> 
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <?=
            $form->field($model, 'reporttype_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(ReportType::find()->all(), 'reporttype_id', 'reporttype_name'),
                'options' => ['placeholder' => 'เลือก..'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-9 col-xs-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>



    <?=  $form->field($model, 'image[]')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'multiple' => true
        ],
        'pluginOptions' => [
         'initialPreview'=>empty($model->image)?[]:[
            Yii::getAlias('@web').'/reportonline/'.$model->image,
         ],
        'allowedFileExtensions'=>['gif', 'jpg','png'],
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
     ]
    ]); ?>

    
         <?=  $form->field($model, 'files')->widget(FileInput::classname(), [
        //'options' => ['accept' => 'image/*'],'multiple' => true= อับโหลดได้หลายไฟล์
        'pluginOptions' => [
         'initialPreview'=>empty($model->files)?[]:[
            Yii::getAlias('@web').'/reportonline/'.$model->files,
         ],
        'allowedFileExtensions'=>['pdf','doc','docx','xls','xlsx','ppt','pptx','rar','zip'],
        'showPreview' => false,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
     ]
    ]); ?>

    <p>รองรับไฟล์นามสกุล 'pdf','doc','docx','xls','xlsx','ppt','pptx','rar','zip' ขนาดไฟล์ไม่เกิน 5 MB</p>



    <div class="row">
        <div class="col-md-3 col-xs-12">
            <?php
            echo '<label class="control-label">วันขอรายงาน</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'order_date',
                'language' => 'th',
                'options' => ['placeholder' => 'ปี-เดือน-วัน'],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                ]
            ]);
            ?>
        </div>
        <div class="col-md-3 col-xs-12">
            <?php
            echo '<label class="control-label">วันกำหนดส่ง</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'defined_date',
                'language' => 'th',
                'options' => ['placeholder' => 'ปี-เดือน-วัน'],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                ]
            ]);
            ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?=
            $form->field($model, 'link_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Link::find()->all(), 'link_id', 'link_name'),
                'options' => ['placeholder' => 'เลือก..'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= \bluezed\scrollTop\ScrollTop::widget() ?>