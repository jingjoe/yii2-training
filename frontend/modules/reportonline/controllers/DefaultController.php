<?php

namespace frontend\modules\reportonline\controllers;

use yii\web\Controller;
// Add AccessControl
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;

class DefaultController extends Controller{
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
    public function actionIndex()
    {
        //return $this->render('index');
        return $this->redirect('reportonline/index');
    }
}
