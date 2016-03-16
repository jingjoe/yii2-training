<?php

namespace frontend\modules\reportonline\controllers;

use Yii;
use frontend\modules\reportonline\models\Reportonline;
use frontend\modules\reportonline\models\ReportonlineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

// add upload
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;

// Add AccessControl
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;

/**
 * ReportonlineController implements the CRUD actions for Reportonline model.
 */
class ReportonlineController extends Controller
{
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
        $searchModel = new ReportonlineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reportonline model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reportonline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      
           $model = new Reportonline();

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $model->files = $model->upload($model,'files');
        $model->image = $model->uploadMultiple($model,'image');
        $model->save();
        //return $this->redirect(['view', 'id' => $model->id]);
        return $this->redirect('index');
    } else {
        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }
          
    }

    /**
     * Updates an existing Reportonline model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
   $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        $model->files = $model->upload($model,'files');
        $model->image = $model->uploadMultiple($model,'image');
        $model->save();
        return $this->redirect('index');
    }  else {
        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }
        
    }

    /**
     * Deletes an existing Reportonline model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reportonline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reportonline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reportonline::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 // funtion download รับค่ามาจาก view    
  
    public function actionDownload($type, $id) {
        $model = $this->findModel($id);
        if ($type === 'files') {
            Yii::$app->response->sendFile($model->getFilesPath() . '/' . $model->files);
            //$model->count_doc +=1; // นับจำนวนดาวน์โหลด
            $model->save();
        }
    }

    
}
