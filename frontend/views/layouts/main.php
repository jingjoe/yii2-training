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
           $submenuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];

           $submenuItems[] = ['label' => 'Register', 'url' => ['/user/registration/register']];
       } else {

           $submenuItems[] = [
               'label' => 'Profile', 'url' => ['/user/settings/profile'],
           ];
           $submenuItems[] = [
               'label' => 'Logout', 'url' => ['/user/security/logout'],'linkOptions' => ['data-method' => 'post']
           ];
       }

       $username = '';
       if (!Yii::$app->user->isGuest) {
           $username = '(' . Html::encode(Yii::$app->user->identity->username) . ')';
       }
       $menuItems = [
         ['label' => 'Home', 'url' => ['/site/index']],
         ['label' => 'Workshop', 'url' => ['index'],'items'=>[
             ['label' => 'ระบบบุคลากร', 'url' => ['employee/index']],
             ['label' => 'ระบบบันทึกตัวชี้วัด', 'url' => ['kpi/index']],
         ]],
         ['label' => 'Report', 'url' => ['report/default']],
         ['label' => 'About', 'url' => ['/site/about']],
         ['label' => 'Contact', 'url' => ['/site/contact']],
         ['label' => 'Right', 'url' => ['/admin']],
         ['label' => 'User' . " ".$username,
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
