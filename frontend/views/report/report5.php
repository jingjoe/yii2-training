<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
$this->title = 'QOF ร้อยละเด็กนักเรียน ป. 1 ได้รับการตรวจช่องปาก';
$this->params['breadcrumbs'][] = ['label' => 'ตัวอย่างรายงานแบบต่าง ๆ', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'Gauges Charts';
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
        <?=
        DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ],
        ]);
        ?>
    </div>
    <div class="form-group">
        <label class="control-label"> ถึง </label>
        <?=
        DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
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
    <div class="panel-heading"><h3 class="panel-title"><span class="glyphicon glyphicon-dashboard"></span> Gauges Charts</h3> </div>
    <div class="panel-body">
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <!-- Default box -->
            <div class="box box-solid">
                <?php foreach ($sql as $dent) {} ?>
                <?php
                $target = $dent['b'];
                $presult = $dent['a'];
                $persent = '0.00';
                if ($target > 0) {
                    $persent = $presult / $target * 100;
                    $persent = number_format($persent, 2);
                }
                ?>
                <div id="container-gauge" style="min-width: 250px; max-width: 270px; height: 270px; margin: 0 auto"></div>
                <?php
                $this->registerJs(" $(function () {
                                    $('#container-gauge').highcharts({

                                        chart: {
                                            type: 'gauge',
                                            plotBackgroundColor: null,
                                            plotBackgroundImage: null,
                                            plotBorderWidth: 0,
                                            plotShadow: false
                                        },

                                        title: {
                                            text: ''
                                        },

                                        pane: {
                                            startAngle: -150,
                                            endAngle: 150,
                                            background: [{
                                                backgroundColor: {
                                                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                                    stops: [
                                                        [0, '#FFF'],
                                                        [1, '#333']
                                                    ]
                                                },
                                                borderWidth: 0,
                                                outerRadius: '109%'
                                            }, {
                                                backgroundColor: {
                                                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                                    stops: [
                                                        [0, '#333'],
                                                        [1, '#FFF']
                                                    ]
                                                },
                                                borderWidth: 1,
                                                outerRadius: '107%'
                                            }, {
                                                // default background
                                            }, {
                                                backgroundColor: '#DDD',
                                                borderWidth: 0,
                                                outerRadius: '105%',
                                                innerRadius: '103%'
                                            }]
                                        },

                                        // the value axis
                                        yAxis: {
                                            min: 0,
                                            max: 100,

                                            minorTickInterval: 'auto',
                                            minorTickWidth: 1,
                                            minorTickLength: 10,
                                            minorTickPosition: 'inside',
                                            minorTickColor: '#666',

                                            tickPixelInterval: 30,
                                            tickWidth: 2,
                                            tickPosition: 'inside',
                                            tickLength: 10,
                                            tickColor: '#666',
                                            labels: {
                                                step: 2,
                                                rotation: 'auto'
                                            },
                                            title: {
                                                text: 'QOF'
                                            },
                                            plotBands: [{
                                                from: 85,
                                                to: 100,
                                                color: '#55BF3B' // green
                                            }, {
                                                from: 65,
                                                to: 84,
                                                color: '#DDDF0D' // yellow
                                            }, {
                                                from: 0,
                                                to: 64,
                                                color: '#DF5353' // red
                                            }]
                                        },
                                        credits: {
                                            enabled: false
                                        },
                                        series: [{
                                            name: 'ผลงานร้อยละ',
                                             data: [" . $persent . "],
                                            tooltip: {
                                                valueSuffix: ''
                                            }
                                        }]

                                    },
                                    // Add some life
                                    function (chart) {

                                    });
                                });
                            ");
                ?>

            </div>
        </div>

        <div class="col-md-8">
            <!-- Default box -->
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'responsive' => true,
            'hover' => true,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'school_name',
                        'header' => 'โรงเรียน'
                    ],
                    [
                        'attribute' => 'b',
                        'header' => 'เป้าหมาย'
                    ],
                    [
                        'attribute' => 'a',
                        'header' => 'ทำได้'
                    ]
                ],
            ]);
        ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.box -->
</div>

    </div>
</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>