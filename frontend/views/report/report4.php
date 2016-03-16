<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
$this->title = 'จำนวน 10 อันดับโรคผู้ป่วย OPD ตามรหัสโรค ICD-10';
$this->params['breadcrumbs'][] = ['label' => 'ตัวอย่างรายงานแบบต่าง ๆ', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'Line Charts';
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
        <?= DatePicker::widget([
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
        <?= DatePicker::widget([
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
    <div class="panel-heading"> <h3 class="panel-title"><span class="glyphicon glyphicon glyphicon-signal"></span> Line Charts</h3> </div>
    <div class="panel-body">
        <div id="container-line"></div>
        <?php

        $categ = [];
        for ($i = 0; $i < count($chart); $i++) {
            $categ[] = $chart[$i]['pdx'];
        }
        $js_categ = implode("','", $categ);

        $data_pdx = [];
        for ($i = 0; $i < count($chart); $i++) {
            $data_pdx[] = $chart[$i]['pdx_count'];
        }
        $js_pdx = implode(",", $data_pdx);

        $data_hn = [];
        for ($i = 0; $i < count($chart); $i++) {
            $data_hn[] = $chart[$i]['hn_count'];
        }
        $js_hn = implode(",", $data_hn);

        $data_vn = [];
        for ($i = 0; $i < count($chart); $i++) {
            $data_vn[] = $chart[$i]['visit_count'];
        }
        $js_vn = implode(",", $data_vn);

        $this->registerJs(" $(function () {
                            $('#container-line').highcharts({
                                title: {
                                    text: 'จำนวน 10 อันดับโรคผู้ป่วย OPD ตามรหัสโรค ICD-10',
                                    x: -20 //center
                                },
                                subtitle: {
                                    text: '',
                                    x: -20
                                },
                                xAxis: {
                                      categories: ['$js_categ'],
                                },
                                yAxis: {
                                    title: {
                                        text: 'จำนวน(ราย)'
                                    },
                                    plotLines: [{
                                        value: 0,
                                        width: 1,
                                        color: '#808080'
                                    }]
                                },
                                tooltip: {
                                    valueSuffix: ''
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'middle',
                                    borderWidth: 0
                                },
                                credits: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'จำนวนวินิจฉัย',
                                    data: [$js_pdx]
                                }, {
                                    name: 'จำนวนราย',
                                    data: [$js_hn]
                                }, {
                                    name: 'จำนวนครั้ง',
                                    data: [$js_vn]
                                }]
                            });
                        });
             ");
        ?>
        <br>
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'pdx',
                    'header' => 'รหัสโรค'
                ],
                [
                    'attribute' => 'icdname',
                    'header' => 'ชื่อโรค'
                ],
                [
                    'attribute' => 'pdx_count',
                    'header' => 'จำนวนวินิจฉัย'
                ],
                [
                    'attribute' => 'hn_count',
                    'header' => 'จำนวนราย'
                ],
                [
                    'attribute' => 'visit_count',
                    'header' => 'จำนวนครั้ง'
                ]
            ],
        ]);
        ?>
    </div>
</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>