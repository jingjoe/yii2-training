<?php

use yii\helpers\Html;
use yii\grid\GridView;
// add pop up windows form
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\reportonline\models\ReportonlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reportonlines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportonline-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <p>
            <?= Html::button('ขอรายงาน', ['value' => Url::to(['reportonline/reportonline/create']), 'title' => 'ขอรายงานออนไลน์', 'class' => 'btn btn-success','id'=>'activity-create-link']); ?>
        </p>
        
        <?php Modal::begin([
        'id' => 'activity-modal',
        'header' => '<h4 class="modal-title">รายงาน</h4>',
        'size'=>'modal-lg',
        //'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
        ]);
        Modal::end();
        ?> 
    
<?php Pjax::begin(['id'=>'customer_pjax_id']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
             'name',
            'typename',
           
           // 'details:ntext',
           // 'image:ntext',
            // 'files:ntext',
           'order_date',
           'defined_date',
            // 'unit',
            // 'link_id',
            // 'finish_date',
            // 'report_status_id',
            // 'create_date',
            // 'modify_date',
            // 'created_by',
            // 'updated_by',
            // 'token_upload',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [
                                'class' => 'activity-view-link',
                                'title' => 'เปิดดูข้อมูล',
                                'data-toggle' => 'modal',
                                'data-target' => '#activity-modal',
                                'data-id' => $key,
                                'data-pjax' => '0',

                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>','#', [
                                'class' => 'activity-update-link',
                                'title' => 'แก้ไขข้อมูล',
                                'data-toggle' => 'modal',
                                'data-target' => '#activity-modal',
                                'data-id' => $key,
                                'data-pjax' => '0',

                            ]);
                        },
                        
                    ]
                ],

        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
<?php $this->registerJs('
        function init_click_handlers(){
            $("#activity-create-link").click(function(e) {
                    $.get(
                        "create",
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("ขอรายงานออนไลน์");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-view-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "view",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เปิดดูข้อมูลรายงาน");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "update",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("แก้ไขข้อมูลรายงาน");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            
        }
        init_click_handlers(); //first run
        $("#customer_pjax_id").on("pjax:success", function() {
          init_click_handlers(); //reactivate links in grid after pjax update
        });');
?>

<?= \bluezed\scrollTop\ScrollTop::widget() ?>