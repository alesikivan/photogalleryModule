<?php

namespace app\modules\photo\modules\admin\controllers;
use app\modules\photo\modules\admin\models\ImageModel;
use Yii;
use app\modules\photo\modules\admin\models\CategoryModel;
use app\modules\photo\modules\admin\models\SubCategoryModel;
use app\modules\photo\modules\admin\models\CategoryModelSearch;
use  app\modules\photo\modules\admin\models\ImageUpload;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * CategoryController implements the CRUD actions for CategoryModel model.
 */
class CategoryController extends Controller
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
     * Lists all CategoryModel models.
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

        $query = CategoryModel::find();

        $category = CategoryModel::find()->all();
        $count = clone $query;

          // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count->count(), 'pageSize' => 10, 'pageSizeParam' => false]);
          // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
              ->limit($pagination->limit)
              ->all();
              // var_dump($articles);die;
              if(isset($_POST['move2']))
              {
                   $from = Yii::$app->request->post('fromCat2');
                   // var_dump($from);die;
                   $category = CategoryModel::find()->where(['title' => $from])->one();

                   $images = ImageModel::find()->where(['category' => $from])->all();


                   foreach ($images as  $value) {
                        $value->delete();
                   }

                   if($category->delete())
                   {
                     Yii::$app->session->setFlash('success', 'Вы успешно удалили' . ' ' . $category->title);
                   }
                   return $this->redirect(['index']);
              }

              if(isset($_POST['move']))
              {
                  $from = Yii::$app->request->post('fromCat');
                  $to = Yii::$app->request->post('category');


                  $categoryFROM = CategoryModel::find()->where(['title' => $from])->one();
                  $categoryTO = CategoryModel::find()->where(['id' => $to])->one();

                  $imagesFROM = ImageModel::find()->where(['category' => $categoryFROM->title])->all();
                  $imagesTO = ImageModel::find()->where(['category' => $categoryTO->title])->all();

                  // обннуляем категрию, в которую перемещаем
                  for($i = 0; $i < count($imagesTO); $i++)
                    {
                         $imagesTO[$i]->key = '0';
                         ($imagesTO[$i])->save();
                    }

                  if($categoryFROM->title != $categoryTO->title)
                  {
                       for($i = 0; $i < count($imagesFROM); $i++)
                    {
                         $imagesFROM[$i]->category = $categoryTO->title;
                         ($imagesFROM[$i])->save();
                    }
               }else {
                    throw new NotFoundHttpException('Вы не можете перенаправить категорию в саму себя.');
               }

                  if($categoryFROM->delete())
                  {
                       Yii::$app->session->setFlash('success', 'Вы успешно удалили' . ' ' . $categoryFROM->title .' ' . ' и переместили фотографии в ' . $categoryTO->title);
                  }

               return $this->redirect(['index']);
             }
             $img_count = [];
             foreach ($articles as $category) {
                  array_push($img_count, ImageUpload::getCount($category->title));
             }
             $list = CategoryModel::getListCate(CategoryModel::find()->all());
        return $this->render('index', [
            'img_count' => $img_count,
            'articles' => $articles,
            'pagination' => $pagination,
            'categories' => $category,
            'list' => $list,
        ]);
    }

    /**
     * Displays a single CategoryModel model.
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
     * Creates a new CategoryModel model.
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
        $model = new CategoryModel();



        $statusList = $model->getStatusList();

        if ($model->load(Yii::$app->request->post())) {

             $model->status = $model->getStatus(Yii::$app->request->post('status'));


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
     * Updates an existing CategoryModel model.
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

        // status
        $statusList = $model->getStatusList();
        $selectItem = $model->findStatus($model->status);



        if ($model->load(Yii::$app->request->post())) {

             // var_dump(Yii::$app->request->post('subcategory'));die;
             $model->status =  $model->getStatus(Yii::$app->request->post('status'));

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
     * Deletes an existing CategoryModel model.
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


    public function actionDeleteimages($id)
    {
       $category = CategoryModel::find()->where(['id' => $id])->one();

       $images = ImageModel::find()->where(['category' => $category->title])->all();

       foreach ($images as $image) {
            $image->delete();
       }
       if($category->delete())
       {
          Yii::$app->session->setFlash('success', 'Вы успешно удалили' . ' ' . $category->title);
       }


       return $this->redirect(['index']);
    }

    public function actionChangeimages($idfrom, $idto)
    {
         $categoryFROM = CategoryModel::find()->where(['id' => $idfrom])->one();
         $categoryTO = CategoryModel::find()->where(['id' => $idto])->one();

         $imagesFROM = ImageModel::find()->where(['category' => $categoryFROM->title])->all();
         $imagesTO = ImageModel::find()->where(['category' => $categoryTO->title])->all();


         if($categoryFROM->title != $categoryTO->title)
         {
              for($i = 0; $i < count($imagesFROM); $i++)
            {
                 $imagesFROM[$i]->category = $categoryTO->title;
                 ($imagesFROM[$i])->save();
            }
       }else {
            throw new NotFoundHttpException('Вы не можете перенаправить категорию в саму себя.');
       }

          if($categoryFROM->delete())
          {
               Yii::$app->session->setFlash('success', 'Вы успешно удалили' . ' ' . $categoryFROM->title .' ' . ' и переместили фотографии в ' . $categoryTO->title);
          }

       return $this->redirect(['index']);
    }
    /**
     * Finds the CategoryModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
