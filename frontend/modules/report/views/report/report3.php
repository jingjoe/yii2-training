<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
$this->title = 'Solid Gauges Charts';
$this->params['breadcrumbs'][] = ['label' => 'ตัวอย่างรายงานแบบต่าง ๆ', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'Solid Gauges Charts';
?>


<div style='display: none'>
    <?=
    Highcharts::widget([
        'scripts' => [
            'highcharts-more',
            //'themes/grid',
            //'modules/exporting',
            'modules/solid-gauge',
        ]
    ]);
    ?>
</div>
<?php
//$webroot = Yii::$app->request->BaseUrl;
$this->registerJsFile('@web/js/chart-donut.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="panel panel-default">
    <div class="panel-heading"> <h3 class="panel-title"><span class="glyphicon glyphicon glyphicon-signal"></span> Solid Gauges Charts</h3> </div>
    <div class="panel-body">
    <!--row1 -->
        <div class="row">
            <!-- col1--->
            <div class="col-md-3" style="text-align: center;">
                <?php
                $data1 = [];
                for ($i = 0; $i < count($chart1); $i++) {
                    $data1[] = $chart1[$i]['cc_hn'];
                }
                $js_cc1 = implode(",", $data1);

                $this->registerJs("
                                var obj_div=$('#chart1');
                                gen_donut(obj_div,'ไม่ลงผลวินิจฉัย OPD',$js_cc1);
                             ");
                ?>
                <div id="chart1" style="width: 300px; height: 200px; float: left"></div>
            </div>
                <!-- col2--->
              <div class="col-md-3" style="text-align: center;">
                <?php
                $data2 = [];
                for ($i = 0; $i < count($chart2); $i++) {
                    $data2[] = $chart2[$i]['cc_hn'];
                }
                $js_cc2 = implode(",", $data2);



                $this->registerJs("
                                var obj_div=$('#chart2');
                                gen_donut(obj_div,'ไม่ลงผลวินิจฉัย IPD',$js_cc2);
                             ");
                ?>
                <div id="chart2" style="width: 300px; height: 200px; float: left"></div>
            </div>
        <!-- col3--->
              <div class="col-md-3" style="text-align: center;">
                <?php
                $data3 = [];
                for ($i = 0; $i < count($chart3); $i++) {
                    $data3[] = $chart3[$i]['cc_hn'];
                }
                $js_cc3 = implode(",", $data3);

                $this->registerJs("
                                var obj_div=$('#chart3');
                                gen_donut(obj_div,'TYPEAREA มีค่าว่าง หรือ ไม่เท่ากับ 4',$js_cc3);
                             ");
                ?>
                <div id="chart3" style="width: 300px; height: 200px; float: left"></div>
            </div>
        <!-- col4--->
                <div class="col-md-3" style="text-align: center;">
                <?php
                $data4 = [];
                for ($i = 0; $i < count($chart4); $i++) {
                    $data4[] = $chart4[$i]['cc_hn'];
                }
                $js_cc4 = implode(",", $data4);

                $this->registerJs("
                                var obj_div=$('#chart4');
                                gen_donut(obj_div,'ข้อมูลอุบัติเหตุ-ฉุกเฉินไม่สมบูรณ์',$js_cc4);
                             ");
                ?>
                <div id="chart4" style="width: 300px; height: 200px; float: left"></div>
            </div>
            </div>
    <!--row2 -->
            <div class="row">
                    <!-- col1--->
                    <div class="col-md-3" style="text-align: center;">
                        <?php
                        $data5 = [];
                        for ($i = 0; $i < count($chart5); $i++) {
                            $data5[] = $chart5[$i]['cc_hn'];
                        }
                        $js_cc5 = implode(",", $data5);

                        $this->registerJs("
                                        var obj_div=$('#chart5');
                                        gen_donut(obj_div,'DiagType OPD ค่าไม่เท่ากับ 1-7 หรือ มีค่าว่าง',$js_cc5);
                                     ");
                        ?>
                        <div id="chart5" style="width: 300px; height: 200px; float: left"></div>
                    </div>
                    <!-- col2--->
                    <div class="col-md-3" style="text-align: center;">
                        <?php
                        $data6 = [];
                        for ($i = 0; $i < count($chart6); $i++) {
                            $data6[] = $chart6[$i]['cc_pid'];
                        }
                        $js_cc6 = implode(",", $data6);

                        $this->registerJs("
                                        var obj_div=$('#chart6');
                                        gen_donut(obj_div,'Person Type 1 และ 3 ไม่เป็นคนไทย',$js_cc6);
                                     ");
                        ?>
                        <div id="chart6" style="width: 300px; height: 200px; float: left"></div>
                    </div>
                    <!-- col3--->
                    <div class="col-md-3" style="text-align: center;">
                        <?php
                        $data7 = [];
                        for ($i = 0; $i < count($chart7); $i++) {
                            $data7[] = $chart7[$i]['cc_pid'];
                        }
                        $js_cc7 = implode(",", $data7);

                        $this->registerJs("
                                        var obj_div=$('#chart7');
                                        gen_donut(obj_div,'Person Type 1 และ 3 สถานะที่ไม่เท่ากับ 9',$js_cc7);
                                     ");
                        ?>
                        <div id="chart7" style="width: 300px; height: 200px; float: left"></div>
                        <span class="label label-warning">ดูรายละเอียด</span>
                    </div>

              </div>
</div>
