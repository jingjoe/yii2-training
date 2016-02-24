<?php

use miloschuman\highcharts\Highcharts;

/* @var $this yii\web\View */
$this->title = 'จำนวนผู้มารับบริการแยกตามแผนก';
$this->params['breadcrumbs'][] = ['label' => 'ตัวอย่างรายงานแบบต่าง ๆ', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'Column Charts';
?>

<div class="panel panel-default">
    <div class="panel-heading"> <h3 class="panel-title"><span class="glyphicon glyphicon glyphicon-signal"></span> Column Charts</h3> </div>
    <div class="panel-body">
<div class="row">
    <!-- col1--->
    <div class="col-md-7">
        <?php
        $opd = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT hn) from vn_stat WHERE vstdate = DATE(NOW()) AND vn_stat.vn NOT IN (SELECT vn FROM er_regist )and pt_subtype = 0")->queryScalar();
        $er = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT vn) from er_regist WHERE vstdate = DATE(NOW())")->queryScalar();
        $lab = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT hn) from lab_head WHERE order_date = DATE(NOW()) and confirm_report = 'Y'")->queryScalar();
        $lr = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT an) from an_stat WHERE ward = 02 and dchdate is NULL")->queryScalar();
        $xray = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT v.vn) from xray_head x LEFT OUTER JOIN vn_stat v on v.vn=x.vn  WHERE v.vstdate = DATE(NOW())")->queryScalar();
        $ipd = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT an) from an_stat WHERE ward = 01 and dchdate is NULL")->queryScalar();
        $dental = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT hn) from dtmain WHERE vstdate = DATE(NOW())")->queryScalar();
        $pcu = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT hn) from vn_stat WHERE vstdate = DATE(NOW()) AND pt_subtype = 1 AND spclty in ('12','13','14','15','16','17','29','32','33','34','35','38')")->queryScalar();
        $ttm = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT hn) from vn_stat WHERE vstdate = DATE(NOW()) and pt_subtype = 0 AND spclty = 31 ")->queryScalar();
        $pyc = Yii::$app->db2->createCommand("SELECT COUNT(DISTINCT hn) from vn_stat WHERE vstdate = DATE(NOW()) and pt_subtype = 0 AND spclty = 38")->queryScalar();

        echo Highcharts::widget([
            'scripts' => [
                //'modules/exporting',
                'themes/dark-unica',
            ],
            'options' => [
                'title' => [
                    'text' => 'จำนวนผู้ป่วยมารับบริการประจำวัน',
                ],
                'xAxis' => [
                    'categories' => ['OPD', 'ER', 'LAB', 'LR', 'X-RAY', 'IPD', 'DENTAL', 'PCU', 'TTM', 'PHYSICAL']
                ],
                'credits' => [
                    'enabled' => false
                ],
                'yAxis' => [
                    'title' => ['text' => 'จำนวนผูมารับบริการ (คน)']
                ],
                'colors' => ["#f45b5b", "#7798BF"],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'จำนวนผู้ป่วย',
                        'data' => [intval($opd), intval($er), intval($lab), intval($lr), intval($xray), intval($ipd), intval($dental), intval($pcu), intval($ttm), intval($pyc)],
                    ],
                ],
            ]
        ]);
        ?>
    </div>
    <!-- col2--->
    <div class="col-md-5">
        <?php
        $village2 = Yii::$app->db2->createCommand(" SELECT COUNT(p.person_id) AS person_total
                                        FROM person p LEFT OUTER JOIN patient pt ON pt.cid=p.cid INNER JOIN village v ON v.village_id=p.village_id
                                        WHERE p.house_regist_type_id IN (1,3)  AND p.person_discharge_id='9' AND p.village_id in(2,9) ")->queryScalar();
        $village3 = Yii::$app->db2->createCommand(" SELECT COUNT(p.person_id) AS person_total
                                        FROM person p LEFT OUTER JOIN patient pt ON pt.cid=p.cid INNER JOIN village v ON v.village_id=p.village_id
                                        WHERE p.house_regist_type_id IN (1,3)  AND p.person_discharge_id='9' AND p.village_id='3' ")->queryScalar();
        $village4 = Yii::$app->db2->createCommand(" SELECT COUNT(p.person_id) AS person_total
                                        FROM person p LEFT OUTER JOIN patient pt ON pt.cid=p.cid INNER JOIN village v ON v.village_id=p.village_id
                                        WHERE p.house_regist_type_id IN (1,3)  AND p.person_discharge_id='9' AND p.village_id='4' ")->queryScalar();
        $village5 = Yii::$app->db2->createCommand(" SELECT COUNT(p.person_id) AS person_total
                                        FROM person p LEFT OUTER JOIN patient pt ON pt.cid=p.cid INNER JOIN village v ON v.village_id=p.village_id
                                        WHERE p.house_regist_type_id IN (1,3)  AND p.person_discharge_id='9' AND p.village_id='5' ")->queryScalar();
        $village6 = Yii::$app->db2->createCommand(" SELECT COUNT(p.person_id) AS person_total
                                        FROM person p LEFT OUTER JOIN patient pt ON pt.cid=p.cid INNER JOIN village v ON v.village_id=p.village_id
                                        WHERE p.house_regist_type_id IN (1,3)  AND p.person_discharge_id='9' AND p.village_id='6' ")->queryScalar();
        $village7 = Yii::$app->db2->createCommand(" SELECT COUNT(p.person_id) AS person_total
                                        FROM person p LEFT OUTER JOIN patient pt ON pt.cid=p.cid INNER JOIN village v ON v.village_id=p.village_id
                                        WHERE p.house_regist_type_id IN (1,3)  AND p.person_discharge_id='9' AND p.village_id='7' ")->queryScalar();
        $village8 = Yii::$app->db2->createCommand(" SELECT COUNT(p.person_id) AS person_total
                                        FROM person p LEFT OUTER JOIN patient pt ON pt.cid=p.cid INNER JOIN village v ON v.village_id=p.village_id
                                        WHERE p.house_regist_type_id IN (1,3)  AND p.person_discharge_id='9' AND p.village_id='8' ")->queryScalar();

        echo Highcharts::widget([
            'scripts' => [
                //'modules/exporting',
                'themes/dark-unica',
            ],
            'options' => [
                'title' => ['text' => 'จำนวนประชากรในเขตพื้นที่รับผิดชอบ'],
                'xAxis' => [
                    'categories' => []
                ],
                'credits' => [
                    'enabled' => false
                ],
                'yAxis' => [
                ],
                'colors' => ['#6AC36A', '#FFD148', '#0563FE', '#FF2F2F', '#8904B1', '#585858', '#00FFFF'],
                'series' => [
                    [
                        'type' => 'pie',
                        'name' => 'จำนวน',
                        'data' => [
                            ['บ้านท่าค่าย', intval($village2)],
                            ['บ้านใหญ่', intval($village3)],
                            ['บ้านน้ำจืด', intval($village4)],
                            ['บ้านท่าเขา', intval($village5)],
                            ['บ้านริมทะเล', intval($village6)],
                            ['บ้านแหลมยาง', intval($village7)],
                            ['บ้านอันเป้า', intval($village8)]
                        ],
                    ],
                ],
            ]
        ]);
        ?>

    </div>
</div>
    </div>
</div>
