<?php

namespace frontend\modules\report\controllers;

use yii\web\Controller;
use yii\db\Query;
use Yii;
use yii\data\ArrayDataProvider;
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;

class ReportController extends Controller {
  public function behaviors(){
      return [
          'access' => [
              'class' => AccessControl::className(),
          ],

          'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [
                  'logout' => ['post'],
              ],
          ],
      ];
  }

    public function actionIndex(){
        return $this->render('index');
    }
    public function actionRep1() {
        return $this->render('report1');
    }

    public function actionRep2() {
    //  $role = isset(Yii::$app->user->identity->groupname) ? Yii::$app->user->identity->groupname : 'ผู้ดูแลระบบ';
    //  if ($role == 'ผู้ดูแลระบบ') {
        // throw new \yii\web\ConflictHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งานส่วนนี้ กรุณาติดต่อผู้ดูแลระบบ !');
      //}

        $date1 = "2015-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }


        $sql = "select 'ประกันสุขภาพ UC' as pttype,count(v.vn)as visit,count(distinct hn)as Person,sum(v.income)as sum_price
        from vn_stat v
        inner join pttype p on p.pttype=v.pttype
        inner join provis_instype pi on pi.code=p.nhso_code
        where v.vstdate between  '$date1'and '$date2' and p.pttype_spp_id in (3,4)
        and v.pdx in (
        select code from icd101 where ( code like 'a%' or code like 'b%' or code like 'c%'
        or code like 'd%' or code like 'e%' or code like 'f%' or code like 'g%' or code like 'h%' or code like 'i%'
        or code like 'j%' or code like 'k%' or code like 'l%' or code like 'm%' or code like 'n%' or code like 'o%'
        or code like 'p%' or code like 'q%' or code like 'r%' or code like 's%' or code like 't%' or code like 'u%'
        or code like 'v%' or code like 'w%' or code like 'x%' or code like 'y%'
        or code in ('z480','z012','z017','z016','z242','z235','z436','z434','z390') or code between 'z20' and 'z299'))

        union
        select 'ประกันสังคม' as pttype,count(v.vn)as visit,count(distinct hn)as Person,sum(v.income)as sum_price
        from vn_stat v inner join pttype p on p.pttype=v.pttype inner join provis_instype pi on pi.code=p.nhso_code
        where v.vstdate between '$date1'and '$date2'and p.pttype_spp_id in (2)
        and v.pdx in (
        select code from icd101 where ( code like 'a%' or code like 'b%' or code like 'c%'
        or code like 'd%' or code like 'e%' or code like 'f%' or code like 'g%' or code like 'h%' or code like 'i%'
        or code like 'j%' or code like 'k%' or code like 'l%' or code like 'm%' or code like 'n%' or code like 'o%'
        or code like 'p%' or code like 'q%' or code like 'r%' or code like 's%' or code like 't%' or code like 'u%'
        or code like 'v%' or code like 'w%' or code like 'x%' or code like 'y%'
        or code in ('z480','z012','z017','z016','z242','z235','z436','z434','z390') or code between 'z20' and 'z299'))

        union
        select 'ข้าราชการ' as pttype,count(v.vn)as visit,count(distinct hn)as Person,sum(v.income)as sum_price
        from vn_stat v
        inner join pttype p on p.pttype=v.pttype
        inner join provis_instype pi on pi.code=p.nhso_code
        where v.vstdate between '$date1'and '$date2' and p.pttype_spp_id in (1)
        and v.pdx in (
        select code from icd101 where ( code like 'a%' or code like 'b%' or code like 'c%'
        or code like 'd%' or code like 'e%' or code like 'f%' or code like 'g%' or code like 'h%' or code like 'i%'
        or code like 'j%' or code like 'k%' or code like 'l%' or code like 'm%' or code like 'n%' or code like 'o%'
        or code like 'p%' or code like 'q%' or code like 'r%' or code like 's%' or code like 't%' or code like 'u%'
        or code like 'v%' or code like 'w%' or code like 'x%' or code like 'y%'
        or code in ('z480','z012','z017','z016','z242','z235','z436','z434','z390') or code between 'z20' and 'z299'))

        union
        select 'ต่างด้าว' as pttype,count(v.vn)as visit,count(distinct hn)as Person,sum(v.income)as sum_price
        from vn_stat v
        inner join pttype p on p.pttype=v.pttype
        inner join provis_instype pi on pi.code=p.nhso_code
        where v.vstdate between '$date1'and '$date2' and p.pttype_spp_id in (5)
        and v.pdx in (
        select code from icd101 where ( code like 'a%' or code like 'b%' or code like 'c%'
        or code like 'd%' or code like 'e%' or code like 'f%' or code like 'g%' or code like 'h%' or code like 'i%'
        or code like 'j%' or code like 'k%' or code like 'l%' or code like 'm%' or code like 'n%' or code like 'o%'
        or code like 'p%' or code like 'q%' or code like 'r%' or code like 's%' or code like 't%' or code like 'u%'
        or code like 'v%' or code like 'w%' or code like 'x%' or code like 'y%'
        or code in ('z480','z012','z017','z016','z242','z235','z436','z434','z390') or code between 'z20' and 'z299'))

        union
        select 'อื่นๆ' as pttype,count(v.vn)as visit,count(distinct hn)as Person,sum(v.income)as sum_price
        from vn_stat v
        inner join pttype p on p.pttype=v.pttype
        inner join provis_instype pi on pi.code=p.nhso_code
        where v.vstdate between '$date1'and '$date2' and p.pttype_spp_id in (6,7)
        and v.pdx in (
        select code from icd101 where ( code like 'a%' or code like 'b%' or code like 'c%'
        or code like 'd%' or code like 'e%' or code like 'f%' or code like 'g%' or code like 'h%' or code like 'i%'
        or code like 'j%' or code like 'k%' or code like 'l%' or code like 'm%' or code like 'n%' or code like 'o%'
        or code like 'p%' or code like 'q%' or code like 'r%' or code like 's%' or code like 't%' or code like 'u%'
        or code like 'v%' or code like 'w%' or code like 'x%' or code like 'y%'
        or code in ('z480','z012','z017','z016','z242','z235','z436','z434','z390') or code between 'z20' and 'z299')) ";


        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
        ]);

        return $this->render('report2', ['dataProvider' => $dataProvider, 'chart' => $data,'sql' => $sql,'date1' => $date1, 'date2' => $date2]);
    }

    public function actionRep3() {

        $sql_chart1 = "SELECT COUNT(DISTINCT hn) AS cc_hn FROM vn_stat WHERE vstdate  BETWEEN '2015-10-01' AND DATE(NOW())AND (pdx='' OR pdx IS NULL)";
        $sql_chart2 = "SELECT COUNT(DISTINCT hn) AS cc_hn FROM an_stat  WHERE  dchdate BETWEEN '2015-10-01' AND DATE(NOW())AND (pdx='' OR pdx IS NULL)";
        $sql_chart3 = "SELECT COUNT(DISTINCT hn) AS cc_hn FROM patient WHERE  patient.hn  IN (SELECT hn FROM vn_stat WHERE vstdate  BETWEEN '2015-10-01' AND DATE(NOW())) AND (patient.type_area='' OR patient.type_area<>'4' OR patient.type_area IS NULL)";
        $sql_chart4 = "SELECT COUNT(DISTINCT p.hn) AS cc_hn
        FROM er_nursing_detail en
        INNER JOIN ovst o ON o.vn=en.vn
        INNER JOIN ovst_seq os ON os.vn=en.vn
        INNER JOIN er_regist e ON e.vn=o.vn
        INNER JOIN er_pt_type erpt ON erpt.er_pt_type=e.er_pt_type AND erpt.accident_code='Y'
        INNER JOIN patient p ON p.hn=o.hn
        INNER JOIN pq_screen  pq ON pq.vn=en.vn
        INNER JOIN opduser ou ON ou.loginname=pq.staff
        WHERE e.vstdate BETWEEN '2015-10-01' AND DATE(NOW())
        AND (en.accident_place_type_id='' OR en.accident_place_type_id IS NULL
        or en.visit_type='' OR en.visit_type IS NULL
        or en.accident_alcohol_type_id='' OR en.accident_alcohol_type_id IS NULL
        or en.accident_drug_type_id='' OR en.accident_drug_type_id IS NULL
        or en.accident_airway_type_id='' OR en.accident_airway_type_id IS NULL
        or en.accident_bleed_type_id='' OR en.accident_bleed_type_id IS NULL
        or en.accident_splint_type_id='' OR en.accident_splint_type_id IS NULL
        or en.accident_fluid_type_id='' OR en.accident_fluid_type_id IS NULL
        or en.er_emergency_type='' OR en.er_emergency_type IS NULL )
        ORDER BY e.enter_er_time";

        $chart1 = Yii::$app->db2->createCommand($sql_chart1)->queryAll();
        $chart2 = Yii::$app->db2->createCommand($sql_chart2)->queryAll();
        $chart3 = Yii::$app->db2->createCommand($sql_chart3)->queryAll();
        $chart4 = Yii::$app->db2->createCommand($sql_chart4)->queryAll();

        return $this->render('report3', [
            'chart1' => $chart1,
            'chart2' => $chart2,
            'chart3' => $chart3,
            'chart4' => $chart4]);
    }

    public function actionRep4() {

        $date1 = "2015-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }


        $sql = "SELECT a.pdx,i.name AS icdname,COUNT(a.pdx) AS pdx_count,COUNT(DISTINCT a.hn) AS hn_count,COUNT(DISTINCT a.vn) AS visit_count
        FROM vn_stat a
        LEFT OUTER JOIN icd101 i ON i.code=a.main_pdx
        WHERE a.vstdate BETWEEN '$date1'and '$date2'
        AND a.pdx<>'' AND a.pdx IS NOT NULL
        AND a.pdx NOT LIKE 'z%'
        GROUP BY a.pdx,i.name
        ORDER BY pdx_count DESC
        LIMIT 10 ";

        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
        ]);

        return $this->render('report4', ['dataProvider' => $dataProvider, 'chart' => $data,'date1' => $date1, 'date2' => $date2]);
    }

    public function actionRep5(){

        $date1 = "2015-04-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }

        $sql = "select vc1.school_name,vc1.village_school_id,(select COUNT(DISTINCT v.person_id)
        from village_student  v
        INNER JOIN person p on p.person_id=v.person_id
        INNER JOIN village_student vs1 ON vs1.person_id=p.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where v.village_school_class_id='4'  and vc1.village_school_id in ('1') ) AS b,COUNT(DISTINCT d.hn) AS a
        from dtmain d
        INNER JOIN vn_stat v ON v.vn=d.vn
        INNER JOIN person pe ON pe.cid=v.cid
        INNER JOIN dttm dt ON dt.code=d.tmcode
        INNER JOIN icd101 i ON i.code=d.icd
        INNER JOIN village_student vs1 ON vs1.person_id=pe.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where d.vstdate between '$date1'and '$date2'
        and vc1.village_school_id in ('1')
        and d.hn in (select pt.hn
        from village_student  v
        left outer join person p on p.person_id=v.person_id
        LEFT OUTER JOIN patient pt ON pt.cid=p.cid
        where v.village_school_class_id='4')
        and d.vn in (SELECT dc.vn FROM dental_care dc WHERE
        dental_care_type_id is not null
        or dc.dental_care_type_id<>''
        or dc.dental_care_service_place_type_id is not null
        or dc.dental_care_service_place_type_id<>'')

        UNION
        select vc1.school_name,vc1.village_school_id,(select COUNT(DISTINCT  v.person_id)
        from village_student  v
        INNER JOIN person p on p.person_id=v.person_id
        INNER JOIN village_student vs1 ON vs1.person_id=p.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where v.village_school_class_id='4'  and vc1.village_school_id in ('2') ) AS b,COUNT(DISTINCT d.hn) AS a
        from dtmain d
        INNER JOIN vn_stat v ON v.vn=d.vn
        INNER JOIN person pe ON pe.cid=v.cid
        INNER JOIN dttm dt ON dt.code=d.tmcode
        INNER JOIN icd101 i ON i.code=d.icd
        INNER JOIN village_student vs1 ON vs1.person_id=pe.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where d.vstdate between '$date1'and '$date2'
        and vc1.village_school_id in ('2')
        and d.hn in (select pt.hn
        from village_student  v
        left outer join person p on p.person_id=v.person_id
        LEFT OUTER JOIN patient pt ON pt.cid=p.cid
        where v.village_school_class_id='4')
        and d.vn in (SELECT dc.vn FROM dental_care dc WHERE
        dental_care_type_id is not null
        or dc.dental_care_type_id<>''
        or dc.dental_care_service_place_type_id is not null
        or dc.dental_care_service_place_type_id<>'')

        UNION
        select vc1.school_name,vc1.village_school_id,(select COUNT(DISTINCT  v.person_id)
        from village_student  v
        INNER JOIN person p on p.person_id=v.person_id
        INNER JOIN village_student vs1 ON vs1.person_id=p.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where v.village_school_class_id='4'  and vc1.village_school_id in ('3') ) AS b,COUNT(DISTINCT d.hn) AS a
        from dtmain d
        INNER JOIN vn_stat v ON v.vn=d.vn
        INNER JOIN person pe ON pe.cid=v.cid
        INNER JOIN dttm dt ON dt.code=d.tmcode
        INNER JOIN icd101 i ON i.code=d.icd
        INNER JOIN village_student vs1 ON vs1.person_id=pe.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where d.vstdate between '$date1'and '$date2'
        and vc1.village_school_id in ('3')
        and d.hn in (select pt.hn
        from village_student  v
        left outer join person p on p.person_id=v.person_id
        LEFT OUTER JOIN patient pt ON pt.cid=p.cid
        where v.village_school_class_id='4')
        and d.vn in (SELECT dc.vn FROM dental_care dc WHERE
        dental_care_type_id is not null
        or dc.dental_care_type_id<>''
        or dc.dental_care_service_place_type_id is not null
        or dc.dental_care_service_place_type_id<>'')

        UNION
        select vc1.school_name,vc1.village_school_id,(select COUNT(DISTINCT  v.person_id)
        from village_student  v
        INNER JOIN person p on p.person_id=v.person_id
        INNER JOIN village_student vs1 ON vs1.person_id=p.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where v.village_school_class_id='4'  and vc1.village_school_id in ('4') ) AS b,COUNT(DISTINCT d.hn) AS a
        from dtmain d
        INNER JOIN vn_stat v ON v.vn=d.vn
        INNER JOIN person pe ON pe.cid=v.cid
        INNER JOIN dttm dt ON dt.code=d.tmcode
        INNER JOIN icd101 i ON i.code=d.icd
        INNER JOIN village_student vs1 ON vs1.person_id=pe.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where d.vstdate between '$date1'and '$date2'
        and vc1.village_school_id in ('4')
        and d.hn in (select pt.hn
        from village_student  v
        left outer join person p on p.person_id=v.person_id
        LEFT OUTER JOIN patient pt ON pt.cid=p.cid
        where v.village_school_class_id='4')
        and d.vn in (SELECT dc.vn FROM dental_care dc WHERE
        dental_care_type_id is not null
        or dc.dental_care_type_id<>''
        or dc.dental_care_service_place_type_id is not null
        or dc.dental_care_service_place_type_id<>'')

        UNION
        select vc1.school_name,vc1.village_school_id,(select COUNT(DISTINCT  v.person_id)
        from village_student  v
        INNER JOIN person p on p.person_id=v.person_id
        INNER JOIN village_student vs1 ON vs1.person_id=p.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where v.village_school_class_id='4'  and vc1.village_school_id in ('11') ) AS b,COUNT(DISTINCT d.hn) AS a
        from dtmain d
        INNER JOIN vn_stat v ON v.vn=d.vn
        INNER JOIN person pe ON pe.cid=v.cid
        INNER JOIN dttm dt ON dt.code=d.tmcode
        INNER JOIN icd101 i ON i.code=d.icd
        INNER JOIN village_student vs1 ON vs1.person_id=pe.person_id
        INNER JOIN village_school vc1 ON vc1.village_school_id=vs1.village_school_id
        where d.vstdate between '$date1'and '$date2'
        and vc1.village_school_id in ('11')
        and d.hn in (select pt.hn
        from village_student  v
        left outer join person p on p.person_id=v.person_id
        LEFT OUTER JOIN patient pt ON pt.cid=p.cid
        where v.village_school_class_id='4')
        and d.vn in (SELECT dc.vn FROM dental_care dc WHERE
        dental_care_type_id is not null
        or dc.dental_care_type_id<>''
        or dc.dental_care_service_place_type_id is not null
        or dc.dental_care_service_place_type_id<>'' )";

        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
        ]);

        return $this->render('report5', ['dataProvider' => $dataProvider, 'sql' => $data,'date1' => $date1, 'date2' => $date2]);
    }
}
