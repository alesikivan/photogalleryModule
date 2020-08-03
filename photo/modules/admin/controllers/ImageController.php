<?php

namespace app\modules\photo\modules\admin\controllers;

use Yii;
use app\modules\photo\modules\admin\models\ImageModel;
use app\modules\photo\modules\admin\models\ImageUpload;
use app\modules\photo\modules\admin\models\CategoryModel;
use app\modules\photo\modules\admin\models\ImageModelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;
/**
 * ImageController implements the CRUD actions for ImageModel model.
 */
class ImageController extends Controller
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
     * Lists all ImageModel models.
     * @return mixed
     */
    public function actionIndex($slug)
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
         $category = CategoryModel::find()->where(['slug' => $slug])->one();
         $query = ImageModel::find()->where(['category' => $category->title]);

        $count = clone $query;

          // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count->count(), 'pageSize' => 10, 'pageSizeParam' => false]);
          // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
              ->limit($pagination->limit)
              ->all();
              // var_dump($articles);die;

        return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'articles' => $articles,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single ImageModel model.
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
     * Creates a new ImageModel model.
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
        $model = new ImageModel();
        $uploadModel = new ImageUpload();

        $waterList = ImageModel::getWaterList();
        $statusList = CategoryModel::getStatusList();
        $categoryList = CategoryModel::getSubCategories((new \yii\db\Query())
         ->from('category')->all());




        // получение файла из формы
        $file = UploadedFile::getInstance($uploadModel, 'image');



        if ($model->load(Yii::$app->request->post())) {
             if(!$uploadModel->sliceExtension2($file->name))
             {
                  throw new NotFoundHttpException('Неверный формат!');
             }

             // var_dump($uploadModel->sliceExtension2($file->name));die;

             if(!$uploadModel->sliceExtension($file->type))
             {
                  throw new NotFoundHttpException('Неверный формат!');
             }


             $model->extension = $uploadModel->sliceExtension($file->type);

             $model->status = CategoryModel::getStatus(Yii::$app->request->post('status'));
             $model->category = CategoryModel::getCategory(Yii::$app->request->post('category'), (new \yii\db\Query())
              ->from('category')->all());
             $model->status = CategoryModel::getStatus(Yii::$app->request->post('status'));
             $model_title = CategoryModel::getCategory(Yii::$app->request->post('category'), (new \yii\db\Query())
              ->from('category')->all());

              $elements = (ImageModel::find()->where(['category' => $model->category])->all());

              // var_dump($elements);die;

              $model->key = '1';


              for ($i=0; $i <count($elements) ; $i++) {
                   $elements[$i]['key'] = '0';
                   $elements[$i]->save();
              }

              // var_dump();die;
             if($model->save())
             {
                  $uploadModel->sendToFolder($uploadModel, $model->id, $model->extension, (Yii::$app->request->post('watermark')));
                  $model->saveImage($model->id, $model->extension);
                  Yii::$app->session->setFlash('success', 'Фотография добавлена');
                  return $this->redirect(['view', 'id' => $model->id,]);
             }else{
                  Yii::$app->session->setFlash('error', 'Ошибка добавлении фотографии');
             }
        }

        return $this->render('create', [
            'model' => $model,
            'uploadModel' => $uploadModel,
            'categoryList' => $categoryList,
            'statusList' => $statusList,
            'waterList' => $waterList,
        ]);
    }

    /**
     * Updates an existing ImageModel model.
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
        $model_for_update = $model->category;


        $model_2 =  ImageModel::find()->where(['id' => $id])->all();
        $my_category = $model_2[0]->category;

        $uploadModel = new ImageUpload();

        $statusList = CategoryModel::getStatusList();
        $categoryList = CategoryModel::getSubCategories((new \yii\db\Query())
         ->from('category')->all());

         $path = $model->image;

         $selectStatus =  CategoryModel::findStatus($model->status);
         $selectCategory = CategoryModel::getSelestSubCategory($model->category, (new \yii\db\Query())
         ->from('category')->all());


        if ($model->load(Yii::$app->request->post())) {

             $model->status = CategoryModel::getStatus(Yii::$app->request->post('status'));
             $model->category = CategoryModel::getCategory(Yii::$app->request->post('category'), (new \yii\db\Query())
              ->from('category')->all());

              // обнуляем фото в старой категории
              $categories_image = ImageModel::find()->where(['category' => $model->category])->all();
              for ($i=0; $i < count($categories_image) ; $i++) {
                   $categories_image[$i]->key = '0';
                   $categories_image[$i]->save();
              }
              // добавляем новое фото в старую категорию и присваеваем статус 1
              $model->key = '1';


             if($model->save())
             {

                                // обновляем элементы в категории из которой перемещаем
                                // обнуляем
                                $all_images = ImageModel::find()->where(['category' => $model_for_update])->all();

                                if($all_images != null)
                                {
                                     for ($i=0; $i < count($all_images) ; $i++) {
                                          $all_images[$i]->key = '0';
                                          $all_images[$i]->save();
                                     }
                                }
                                // максимальному по дате присваеваем еденицу
                                $date = (new \yii\db\Query())
                                 ->from('image')
                                 ->where(['category' => $model_for_update])->max('date');
                                 $max_image = ImageModel::find()->where(['date' => $date])->one();
                                 // var_dump($max_image->title);die;
                                if($max_image != null)
                                {
                                     $max_image->key = '1';
                                     $max_image->save();
                                }
                  return $this->redirect(['view', 'id' => $model->id]);
             }
        }

        return $this->render('update', [
             'path' => $path,
            'model' => $model,
            'uploadModel' => $uploadModel,
            'selectStatus' => $selectStatus,
            'selectCategory' => $selectCategory,
            'categoryList' => $categoryList,
            'statusList' => $statusList,
        ]);
    }

    /**
     * Deletes an existing ImageModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['category/index']);
    }

    /**
     * Finds the ImageModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImageModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImageModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
