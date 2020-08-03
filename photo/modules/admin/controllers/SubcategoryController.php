<?php

namespace app\modules\photo\modules\admin\controllers;

use Yii;
use app\modules\photo\modules\admin\models\SubCategoryModel;
use app\modules\photo\modules\admin\models\SubCategoryModelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubcategoryController implements the CRUD actions for SubCategoryModel model.
 */
class SubcategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SubCategoryModel models.
     * @return mixed
     */
    public function actionIndex()
    {
         $myUserId = Yii::$app->user->id;
         if($myUserId == null)
         {

                   throw new NotFoundHttpException('Только для администраторов!');

         }else{
              if($myUserId == 101)
              {
                   throw new NotFoundHttpException('Только для администраторов!');
              }
         }
        $searchModel = new SubCategoryModelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubCategoryModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         $myUserId = Yii::$app->user->id;
         if($myUserId == null)
         {

                   throw new NotFoundHttpException('Только для администраторов!');

         }else{
              if($myUserId == 101)
              {
                   throw new NotFoundHttpException('Только для администраторов!');
              }
         }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SubCategoryModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         $myUserId = Yii::$app->user->id;
         if($myUserId == null)
         {

                   throw new NotFoundHttpException('Только для администраторов!');

         }else{
              if($myUserId == 101)
              {
                   throw new NotFoundHttpException('Только для администраторов!');
              }
         }
        $model = new SubCategoryModel();

        $statusList = $model->getStatusList();

        if ($model->load(Yii::$app->request->post())) {
             $model->status = $status = $model->getStatus(Yii::$app->request->post('status'));
             if($model->save())
             {
                  return $this->redirect(['view', 'id' => $model->id]);
             }

        }

        return $this->render('create', [
            'model' => $model,
            'statusList' => $statusList,
        ]);
    }

    /**
     * Updates an existing SubCategoryModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
         $myUserId = Yii::$app->user->id;
         if($myUserId == null)
         {

                   throw new NotFoundHttpException('Только для администраторов!');

         }else{
              if($myUserId == 101)
              {
                   throw new NotFoundHttpException('Только для администраторов!');
              }
         }
        $model = $this->findModel($id);
        $statusList = $model->getStatusList();
        $selectItem = $model->findStatus($model->status);


        if ($model->load(Yii::$app->request->post())) {

             $model->status = $model->getStatus(Yii::$app->request->post('status'));
             if($model->save())
             {
                return $this->redirect(['view', 'id' => $model->id]);
             }
        }

        return $this->render('update', [
            'model' => $model,
            'statusList' => $statusList,
            'selectItem' => $selectItem,
        ]);
    }

    /**
     * Deletes an existing SubCategoryModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubCategoryModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubCategoryModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubCategoryModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}