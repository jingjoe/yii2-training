<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    //= Html::encode($this->title)
    <title><?= Yii::$app->name ?></title> //การเรียกใช้งาน title จาก confin\main.php
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yii2-Training',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
           $submenuItems[] = ['label' => 'เข้าสู่ระบบ', 'url' => ['/user/security/login']];

           $submenuItems[] = ['label' => 'ลงทะเบียน', 'url' => ['/user/registration/register']];
       } else {

           $submenuItems[] = [
               'label' => 'ข้อมูลส่วนตัว', 'url' => ['/user/settings/profile'],
           ];
           $submenuItems[] = [
               'label' => 'ออกจากระบบ', 'url' => ['/user/security/logout'],'linkOptions' => ['data-method' => 'post']
           ];
       }

       $username = '';
       if (!Yii::$app->user->isGuest) {
           $username = '(' . Html::encode(Yii::$app->user->identity->username) . ')';
       }
       $menuItems = [
         ['label' => 'HOME', 'url' => ['/site/index']],
         ['label' => 'ระบบของฉัน', 'url' => ['index'],'items'=>[
             ['label' => 'ระบบบุคลากร', 'url' => ['/personals/default']],
             ['label' => 'ระบบขอรายงานออนไลน์', 'url' => ['/reportonline/default']],
             ['label' => 'ระบบบันทึกตัวชี้วัด', 'url' => ['kpi/index']],
             ['label' => 'ประกาศข่าว', 'url' => ['news/index']],
             ['label' => 'เว็บบอร์ด', 'url' => ['webboard/index']],
         ]],
         ['label' => 'รายงาน', 'url' => ['report/index']],
         
         //['label' => 'About', 'url' => ['/site/about']],
         //['label' => 'Contact', 'url' => ['/site/contact']],
         ['label' => 'จัดการผู้ใช้', 'url' => ['/user/admin/index']],
         ['label' => 'จัดการสิทธิใช้งาน', 'url' => ['/admin']],
         ['label' => 'ผู้ใช้งาน' . " ".$username,
          'items' => $submenuItems
         ],
       ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">ไอทีพังงา &copy; Yii2 WebApplication Basic For You <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
