<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
$this->title = 'จำนวนครั้งผู้ป่วยรับบริการทั่วไปจำแนกสิทธิและค่าใช้จ่าย(ไม่นับส่งเสริม)';
$this->params['breadcrumbs'][] = ['label' => 'ตัวอย่างรายงานแบบต่าง ๆ', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'Bar Charts';
?>

<div style='display: none'>
    <?=
    Highcharts::widget([
        'scripts' => [
            'highcharts-more',
            'themes/grid',
            //'modules/exporting',
            'modules/solid-gauge',
        ]
    ]);
    ?>
</div>

<div class='well'>
    <?php $form = ActiveForm::begin(['layout' => 'inline']); ?>
    <div class="form-group">
        <label class="control-label"> เลือกวันที่ </label>
        <?php
        echo DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'changeMonth' => true,
                'changeYear' => true,
                'todayHighlight' => true
            ]
        ]);
        ?>

    </div>
    <div class="form-group">
        <label class="control-label"> ถึง </label>
        <?php
        echo DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'changeMonth' => true,
                'changeYear' => true,
                'todayHighlight' => true
            ]
        ]);
        ?>
    </div>
    <div class="form-group">
    <?= Html::submitButton('ประมวลผล', ['class' => 'btn btn-warning btn-flat']) ?>
    </div><!-- /.input group -->
<?php ActiveForm::end(); ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading"> <h3 class="panel-title"><span class="glyphicon glyphicon glyphicon-signal"></span> Bar Charts</h3> </div>
    <div class="panel-body">
         <div id="container-bar"></div>
        <?php

        $categ = [];
        for ($i = 0; $i < count($chart); $i++) {
            $categ[] = $chart[$i]['pttype'];
        }
        $js_categ = implode("','", $categ);

        $data_person = [];
        for ($i = 0; $i < count($chart); $i++) {
            $data_person[] = $chart[$i]['Person'];
        }
        $js_person = implode(",", $data_person);

        $data_visit = [];
        for ($i = 0; $i < count($chart); $i++) {
            $data_visit[] = $chart[$i]['visit'];
        }
        $js_visit = implode(",", $data_visit);

        $data_price = [];
        for ($i = 0; $i < count($chart); $i++) {
            $data_price[] = $chart[$i]['sum_price'];
        }
        $js_price = implode(",", $data_price);

        $this->registerJs(" $(function () {
            $('#container-bar').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'จำนวนครั้งผู้ป่วยรับบริการทั่วไปจำแนกสิทธิและค่าใช้จ่าย(ไม่นับส่งเสริม)'
                },
                subtitle: {

                },
                xAxis: {
                      categories: ['$js_categ'],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Population (millions)',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 80,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'จำนวนคน',
                    data: [$js_person]
                }, {
                    name: 'จำนวนครั้ง',
                    data: [$js_visit]
                }, {
                    name: 'จำนวนเงิน (บาท)',
                    data: [$js_price]
                }]
            });
        });
        ");
?>
         <br>
         <div class="box-tools pull-right">
             <!-- dialog sql -->
             <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg">sql script</button>
             <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                 <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h4 class="modal-title" id="gridSystemModalLabel">SQL : จำนวนครั้งผู้ป่วยรับบริการทั่วไปจำแนกสิทธิและค่าใช้จ่าย(ไม่นับส่งเสริม)</h4>
                       </div>
                      <div class="modal-body">
                          <?= $sql ?>
                      </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                     </div>
                 </div>
             </div>
         </div>

        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'pttype',
                    'header' => 'ประเภทสิทธิการรักษา'
                ],
                                [
                'attribute' => 'Person',
                    'header' => 'จำนวนคน'
                ],
                [
                    'attribute' => 'visit',
                    'header' => 'จำนวนครั้ง'
                ],

                [
                    'attribute' => 'sum_price',
                    'header' => 'จำนวนเงิน (บาท)'
                ]
            ],
        ]);
        ?>
    </div>
</div>
