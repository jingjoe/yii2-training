<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;


use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\TypeaheadBasic;
use kartik\widgets\DepDrop;
use kartik\widgets\FileInput;
use yii\widgets\MaskedInput;
use kartik\date\DatePicker;


use frontend\modules\personals\models\Personal;
use frontend\modules\personals\models\Religion;
use frontend\modules\personals\models\Marrystatus;
use frontend\modules\personals\models\Position;
use frontend\modules\personals\models\Persontype;
use frontend\modules\personals\models\Education;

use frontend\modules\personals\models\Depart;
use frontend\modules\personals\models\DepartGroup;
use frontend\modules\personals\models\Province;
use frontend\modules\personals\models\Amphur;
use frontend\modules\personals\models\District;
use frontend\modules\personals\models\Zipcode;


use dektrium\user\models\User;

use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Personal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-form">

   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->errorSummary($model); ?>
<div class="page-header">
  <h4>ข้อมูลส่วนตัว </h4>
</div>
<div class="row">
    <div class="col-md-2 col-sm-12">
      <?= $form->field($model, 'cid')->widget(MaskedInput::classname(), [
        'mask' => '9-9999-99999-999',
        'clientOptions'=>[
            'removeMaskOnSubmit'=>true //กรณีไม่ต้องการให้มันบันทึก format ลงไปด้วยเช่น 9-9999-99999-999 ก็จะเป็น 9999999999999
        ]
    ]) ?>
    </div>
    <div class="col-md-2 col-sm-12">
       <?= $form->field($model, 'pname')->dropdownList(Personal::itemAlias('pname'),[
            'prompt'=>'เลือกคำนำหน้า'
       ]); ?>
    </div>
   <div class="col-md-4 col-sm-12">
        <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
    </div>
   <div class="col-md-4 col-sm-12">
       <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
    </div>
</div>

    <div class="row">
        <div class="col-md-2 col-sm-12">
             <?= $form->field($model, 'sex')->inline()->radioList(Personal::itemAlias('sex')) ?>
        </div>
        <div class="col-md-1 col-sm-12">
            <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-2 col-sm-12">
            <?=
            $form->field($model, 'religion_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Religion::find()->all(), 'religion_id', 'religion_name'),
                'options' => ['placeholder' => 'เลือกศาสนา'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>

        <div class="col-md-2 col-sm-12">
            <?= $form->field($model, 'bloodgroup')->dropDownList([ 'A' => 'A', 'B' => 'B', 'AB' => 'AB', 'O' => 'O',], ['prompt' => '']) ?>
        </div>
        <div class="col-md-2 col-sm-12">
            <?=
            $form->field($model, 'marrystatus_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Marrystatus::find()->all(), 'marrystatus_id', 'marrystatus_name'),
                'options' => ['placeholder' => 'เลือกสถานภาพ'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>

        <div class="col-md-3 col-sm-12">
            <?php
            echo '<label class="control-label">วันเกิด</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'birthdate',
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
    </div>

<div class="page-header">
<h4>ข้อมูลสำหรับการติดต่อ </h4>
</div>
<?= $form->field($model, 'address')->textInput() ?>
<div class="row">
    <div class="col-md-3 col-sm-12">
       <?= $form->field($model, 'province_id')->dropdownList(
            ArrayHelper::map(Province::find()->all(), 'province_id', 'province_name'),
            [
                'id'=>'ddl-province',
                'prompt'=>'เลือกจังหวัด'
       ]); ?>
    </div>
    <div class="col-md-3 col-sm-12">
       <?= $form->field($model, 'amphur_id')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-amphur'],
              'data' => [],
            'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ...',
                'url'=>Url::to(['/personal/get-amphur'])
            ]
        ]); ?>
    </div>
    <div class="col-md-3 col-sm-12">
      <?= $form->field($model, 'district_id')->widget(DepDrop::classname(), [
          'options'=>['id'=>'ddl-district'],
             'data' => [],
            'pluginOptions'=>[
                'depends'=>['ddl-province', 'ddl-amphur'],
                'placeholder'=>'เลือกตำบล...',
                'url'=>Url::to(['/personal/get-district'])
            ]
        ]); ?>
    </div>
        <div class="col-md-3 col-sm-12">
        <?= $form->field($model, 'zip_code')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-zipcode'],
             'data' => [],
            'pluginOptions'=>[
                'depends'=>['ddl-province', 'ddl-amphur','ddl-district'],
                'placeholder'=>'เลือกรหัสไปษณี...',
                'url'=>Url::to(['/personal/get-zipcode'])
            ]
        ]); ?>
    </div>
</div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <?= $form->field($model, 'lng')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'phone')->widget(MaskedInput::className(), ['mask' => '999-9999999',]) ?>
        </div>

        <div class="col-md-3 col-xs-12">
            <?=
            $form->field($model, 'email')->widget(MaskedInput::className(), [
                'name' => 'input-36',
                'clientOptions' => [
                    'alias' => 'email',
                ],
            ])
            ?>
        </div>
    </div>

<div class="page-header">
<h4>ข้อมูลการทำงาน </h4>
</div>
      <?= $form->field($model, 'skill')->textarea(['rows' => 2]) ?>
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <?php
            echo '<label class="control-label">วันเข้าทำงาน</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'startwork_date',
                'language' => 'th',
                'options' => ['placeholder' => 'วันเข้าทำงาน'],
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                ]
            ]);
            ?>
        </div>
        <div class="col-md-4 col-xs-12">
            <?= $form->field($model, 'position_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Position::find()->all(), 'position_id', 'position_name'),
                'options' => ['placeholder' => 'เลือกตำแหน่ง'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
               <div class="col-md-3 col-xs-12">
            <?= $form->field($model, 'education_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Education::find()->all(), 'education_id', 'education_name'),
                'options' => ['placeholder' => 'เลือกระดับการศึกษา'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
  

<!--row8 -->
    <div class="row">
        <!-----------------Start DepDrop แผนก---------------->
        <div class="col-md-5 col-xs-12">
            <?=
            $form->field($model, 'group_id')->dropdownList(
                    ArrayHelper::map(DepartGroup::find()->all(), 'group_id', 'group_name'), [
                'id' => 'ddl-departgroup',
                'prompt' => 'เลือกฝ่าย'
                    ]
            );
            ?>
        </div>

        <div class="col-md-5 col-xs-12">
            <?= $form->field($model, 'depart_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'ddl-depart'],
                'data' => [],
                //'data' => $dep,
                'type' => DepDrop::TYPE_SELECT2,
                'pluginOptions' => [
                    'depends' => ['ddl-departgroup'],
                    'placeholder' => 'เลือกแผนก',
                    'url' => Url::to(['/personal/get-depart'])
                ]
            ]);
            ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'persontype_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Persontype::find()->all(), 'persontype_id', 'persontype_name'),
                'options' => ['placeholder' => 'เลือกสถานะ'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <!-----------------End DepDrop แผนก---------------->

    <?= $form->field($model, 'img')->textarea(['rows' => 2]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
