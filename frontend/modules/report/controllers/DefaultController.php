<?php

namespace frontend\modules\report\controllers;

use yii\web\Controller;
class DefaultController extends Controller{

    public function actionIndex(){
        return $this->redirect(['report/index']);
    }
}
