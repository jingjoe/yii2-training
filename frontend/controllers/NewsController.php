<?php

namespace frontend\controllers;

use Yii;
use frontend\models\News;
use frontend\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
// Add upload
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
// AccessControl
use mdm\admin\components\AccessControl;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'allowActions' => ['index']
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new News();
        $model->token_upload = substr(Yii::$app->getSecurity()->generateRandomString(), 10);

        if ($model->load(Yii::$app->request->post())) {

            //  $this->Uploads(false);

            $model->img = UploadedFile::getInstance($model, 'img');

            if ($model->img && $model->validate()) {
                $fileName = ($model->img);
                $image = $model->img;
                $model->img = $fileName;
                $image->saveAs('news/' . $fileName);
                if ($model->save()) {
                    //return $this->redirect(['view', 'id' => $model->id]);
                    return $this->redirect(['index']);
                }
            } else if ($model->save()) {
                //return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
                    'model' => $model
        ]);
    }

    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $tempResume = $model->img;

        if ($model->load(Yii::$app->request->post())) {

            //$this->Uploads(false);

            $model->img = UploadedFile::getInstance($model, 'img');
            if ($model->img && $model->validate()) {
                $fileName = ($model->img);
                $image = $model->img;
                $model->img = $fileName;
                $image->saveAs('news/' . $fileName);
                if ($model->save()) {
                    // return $this->redirect(['view', 'id' => $model->img]);
                    return $this->redirect('@web/news/index');
                }
            } else {
                $model->img = $tempResume;
                if ($model->save()) {
                    return $this->redirect('@web/news/index');
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
