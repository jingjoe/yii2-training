<?php
$this->title = Yii::t('app', 'รายงานจากฐาน HOSxP');
$this->params['breadcrumbs'][] = 'ตัวอย่างรายงานแบบต่างๆ จากฐาน HOSxP';

use yii\helpers\Html;
?>

<div class="panel panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> ตัวอย่างรายงานแบบต่างๆ จากฐาน HOSxP</h3></div>
    <div class="panel-body">
        <div class="well well-sm">
            <?= Html::a('<i class="glyphicon glyphicon-minus"></i> จำนวนผู้มารับบริการแยกตามแผนก (Column Charts)', ['report/rep1']); ?> <br>
            <?= Html::a('<i class="glyphicon glyphicon-minus"></i> จำนวนครั้งผู้ป่วยรับบริการทั่วไปจำแนกสิทธิและค่าใช้จ่าย (Bar Charts)', ['report/rep2']); ?>  <br>
            <?= Html::a('<i class="glyphicon glyphicon-minus"></i> จำนวนผู้ป่วย(Patient) TYPEAREA มีค่าว่าง (Solid Gauges Charts)', ['report/rep3']); ?>  <br>
            <?= Html::a('<i class="glyphicon glyphicon-minus"></i> จำนวน 10 อันดับโรคผู้ป่วย OPD ตามรหัสโรค ICD-10 (Line Charts)', ['report/rep4']); ?>  <br>
            <?= Html::a('<i class="glyphicon glyphicon-minus"></i> QOF ร้อยละเด็กนักเรียน ป. 1 ได้รับการตรวจช่องปาก (Gauges Charts)', ['report/rep5']); ?>  <br>
            <?= Html::a('<i class="glyphicon glyphicon-minus"></i> จำนวนผู้มารับบริการแยกผู้ป่วย OPD/IPD ตามปีงบประมาณที่เลือก', ['report/rep6']); ?>  <br>
            <?= Html::a('<i class="glyphicon glyphicon-minus"></i> รายงานจำนวนประชากรแยกตามหมู่บ้าน (รายงานแบบมีเงื่อนไข)', ['report/rep7']); ?>  <br>
        </div>
    </div>
</div>
