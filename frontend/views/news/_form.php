<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\VarDumper;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use franciscomaya\sceditor\SCEditor;
// ลิงค์โมดูล dropdownlist
use frontend\models\CategoryNews;
use frontend\models\News;
/* @var $this yii\web\View */
/* @var $model frontend\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <?=
            $form->field($model, 'cat_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(CategoryNews::find()->all(), 'cat_id', 'cat_name'),
                'options' => ['placeholder' => 'เลือก..'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-9 col-xs-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
        <?= $form->field($model, 'detail')->widget(SCEditor::className(), [
        'options' => [
            'rows' => 10 ,
            'cols' => 178
        ],
        'clientOptions' => [
            'plugins' => 'bbcode',
        ]
        ]) 
        ?>

        <div class="row">
        <div class="col-md-12 col-xs-12">
            <?=
            $form->field($model, 'img')->widget(FileInput::classname(), [
                //'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview' => empty($model->img) ? [] : [
                        Yii::getAlias('@web') . '/news/' . $model->img,
                            ],
                    'allowedFileExtensions' => ['png'],
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]);
            ?>
            <p class="help-block"> รองรับนามสกุล pdf ขนาดไม่เกิน 1 MB </p>
        </div>
        </div>
    <div class="col-md-12 col-sm-12">
             <?= $form->field($model, 'status')->inline()->radioList(News::itemAlias('status')) ?>
        </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
