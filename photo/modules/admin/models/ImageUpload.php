<?php

namespace app\modules\photo\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\modules\photo\modules\admin\models\CategoryModel;
use app\modules\photo\modules\admin\models\ImageModel;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ImageUpload extends Model
{

     public $image;

     public function rules()
    {
        return [
            ['image', 'required'],
            ['image', 'file', 'extensions' => 'jpg, png, gif, jpeg'],
            // ['image', 'match', 'pattern'=>'/^[jpg]+$/', 'message'=>'Username must contain uppercase letter.'],
        ];
    }

     public function sendToFolder($model, $id, $ext, $watermark)
     {


          if (!file_exists('../web/images/photogallery')) {
              mkdir('../web/images/photogallery', 0777, true);
          }

               if($watermark == 0)
               {
                    $file = UploadedFile::getInstance($model, 'image');
                    $file->saveAs('../web/images/photogallery/'  . ($id. "." . $ext));
               }elseif ($watermark == '1' || $watermark == '2' || $watermark == '3' || $watermark == '4') {
                    $file = UploadedFile::getInstance($model, 'image');
                    $file->saveAs(Yii::getAlias('../web/images/photogallery/')  . ($id. "." . $ext));

                    if($ext == 'jpeg')
                    {
                         $this->watermark_image_adding_for_jpeg(Yii::getAlias('@app/web/images/photogallery/')  . ($id. "." . $ext), $watermark);
                    }elseif ($ext == 'jpg') {
                         $this->watermark_image_adding_for_jpeg(Yii::getAlias('@app/web/images/photogallery/')  . ($id. "." . $ext), $watermark);
                    }elseif ($ext == 'png') {
                         $this->watermark_image_adding_for_png(Yii::getAlias('@app/web/images/photogallery/')  . ($id. "." . $ext), $watermark);
                    }elseif ($ext == 'gif') {
                         $this->watermark_image_adding_for_gif(Yii::getAlias('@app/web/images/photogallery/')  . ($id. "." . $ext), $watermark);
                    }
               }


     }


     public function getWatermark($mark)
     {
          if($mark == '0')
          {
               return 'do not use';
          }elseif ($mark == '1') {
               return 'left top';
          }elseif ($mark == '2') {
               return 'right top';
          }elseif ($mark == '3') {
               return 'left bottom';
          }elseif ($mark == '4') {
               return 'right bottom';
          }
     }
     public function sliceExtension2($str)
     {
          $t = explode(".", $str);
          $ext = $t[count($t) - 1];
          $final = false;
          $letters = ['P', 'N', 'G', 'J', 'P', 'E', 'G', 'I', 'F',];
          for($i = 0; $i < strlen($str); $i++){
               foreach ($letters as $letter) {
                    if($str[$i] == $letter)
                    {
                         $final = true;
                    }
               }
          }
          if($final)
          {
               return false;
          }
          return true;
     }

     public function sliceExtension($str)
     {
          $t = explode("/", $str);

          if (in_array('gif', $t))
          {
               return 'gif';
          }elseif (in_array( 'jpg', $t)) {
               return 'jpg';
          }elseif (in_array('jpeg', $t)) {
               return 'jpeg';
          }elseif (in_array('png', $t)) {
               return 'png';
          }
          return false;
     }


     public function getImage($path)
     {
          return Yii::getAlias('@app/modules/photo/web//images/photogallery/')  . ($path);
     }


     public function getImg($slug)
     {
          $category = CategoryModel::find()->where(['slug' => $slug])->one();
          $images = ImageModel::find()->where(['category' => $category->title])->all();
          return $images;
     }


     public function getCount($title)
     {
          $category = CategoryModel::find()->where(['title' => $title])->one();
          $images = ImageModel::find()->where(['category' => $category->title])->all();
          return count($images);
     }

     public function getCount2($title, $status)
     {
          $category = CategoryModel::find()->where(['title' => $title])->one();
          if($status == null)
          {
               $images = ImageModel::find()->where(['category' => $category->title, 'status' => 'guest'])->all();
          }elseif ($status == '101') {
               $images = ImageModel::find()->where(['category' => $category->title, 'status' => ['guest', 'user']])->all();
          }else {
               $images = ImageModel::find()->where(['category' => $category->title, 'status' => ['guest', 'user', 'admin']])->all();
          }
          return count($images);
     }




     public function watermark_image_adding_for_jpeg($oldimage_name, $watermarkNumber){
          // получаем имя изображения, используемого в качестве водяного знака
          $image_path = Yii::getAlias('@app/modules/photo/web//images/watermark/')  . ('iam.png');
          // получаем размеры исходного изображения
          list($owidth,$oheight) = getimagesize($oldimage_name);
          // задаем размеры для выходного изображения
          $width =$this->getWidth($oldimage_name);
          $height = $this->getHeigth($oldimage_name);
          // создаем выходное изображение размерами, указанными выше
          $im = imagecreatetruecolor($width, $height);
          $img_src = imagecreatefromjpeg($oldimage_name);
          // наложение на выходное изображение, исходного
          imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
          $watermark = imagecreatefrompng($image_path);
          // получаем размеры водяного знака
          list($w_width, $w_height) = getimagesize($image_path);
          // определяем позицию расположения водяного знака

          $pos_x = 0;
          $pos_y = 0;
          if($watermarkNumber == '1'){
               $pos_x = 0;
               $pos_y = 0;
          }elseif ($watermarkNumber == '2') {
               $pos_x = $width - $w_width;
               $pos_y = 0;
          }elseif ($watermarkNumber == '3') {
               $pos_x = 0;
               $pos_y = $height - $w_height;
          }elseif ($watermarkNumber == '4') {
               $pos_x = $width - $w_width;
               $pos_y = $height - $w_height;
          }
          // накладываем водяной знак
          imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
          // сохраняем выходное изображение, уже с водяным знаком в формате jpg и качеством 100
          imagejpeg($im, $oldimage_name, 99);
          // уничтожаем изображения
          imagedestroy($im);
          // unlink($oldimage_name);
          return true;
     }


     public function watermark_image_adding_for_png($oldimage_name, $watermarkNumber){
          // получаем имя изображения, используемого в качестве водяного знака
          $image_path = Yii::getAlias('@app/modules/photo/web//images/watermark/')  . ('iam.png');
          // получаем размеры исходного изображения
          list($owidth,$oheight) = getimagesize($oldimage_name);
          // задаем размеры для выходного изображения
          $width = $this->getWidth($oldimage_name);
          $height = $this->getHeigth($oldimage_name);
          // создаем выходное изображение размерами, указанными выше
          $im = imagecreatetruecolor($width, $height);
          $img_src = imagecreatefrompng($oldimage_name);
          // наложение на выходное изображение, исходного
          imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
          $watermark = imagecreatefrompng($image_path);
          // получаем размеры водяного знака
          list($w_width, $w_height) = getimagesize($image_path);
          // определяем позицию расположения водяного знака
          $pos_x = 0;
          $pos_y = 0;
          if($watermarkNumber == '1'){
               $pos_x = 0;
               $pos_y = 0;
          }elseif ($watermarkNumber == '2') {
               $pos_x = $width - $w_width;
               $pos_y = 0;
          }elseif ($watermarkNumber == '3') {
               $pos_x = 0;
               $pos_y = $height - $w_height;
          }elseif ($watermarkNumber == '4') {
               $pos_x = $width - $w_width;
               $pos_y = $height - $w_height;
          }

          // накладываем водяной знак
          imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
          // сохраняем выходное изображение, уже с водяным знаком
          imagejpeg($im, $oldimage_name, 99);
          // уничтожаем изображения
          imagedestroy($im);
          // unlink($oldimage_name);
          return true;
     }

     public function watermark_image_adding_for_gif($oldimage_name, $watermarkNumber){
          // получаем имя изображения, используемого в качестве водяного знака
          $image_path = Yii::getAlias('@app/modules/photo/web//images/watermark/')  . ('iam.png');
          // получаем размеры исходного изображения
          list($owidth,$oheight) = getimagesize($oldimage_name);
          // задаем размеры для выходного изображения
          $width = $this->getWidth($oldimage_name);
          $height = $this->getHeigth($oldimage_name);
          // создаем выходное изображение размерами, указанными выше
          $im = imagecreatetruecolor($width, $height);
          $img_src = imagecreatefromgif($oldimage_name);
          // наложение на выходное изображение, исходного
          imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
          $watermark = imagecreatefrompng($image_path);
          // получаем размеры водяного знака
          list($w_width, $w_height) = getimagesize($image_path);
          // определяем позицию расположения водяного знака
          $pos_x = 0;
          $pos_y = 0;
          if($watermarkNumber == '1'){
               $pos_x = 0;
               $pos_y = 0;
          }elseif ($watermarkNumber == '2') {
               $pos_x = $width - $w_width;
               $pos_y = 0;
          }elseif ($watermarkNumber == '3') {
               $pos_x = 0;
               $pos_y = $height - $w_height;
          }elseif ($watermarkNumber == '4') {
               $pos_x = $width - $w_width;
               $pos_y = $height - $w_height;
          }

          // накладываем водяной знак
          imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
          // сохраняем выходное изображение, уже с водяным знаком в формате jpg и качеством 100
          imagegif($im, $oldimage_name, 99);
          // уничтожаем изображения
          imagedestroy($im);
          // unlink($oldimage_name);
          return true;
     }

     public function getHeigth($img)
   {
         $pieces = explode(".",$img);
         if($pieces[1] == 'png')
         {
              return imagesy(imagecreatefrompng($img));
         }elseif ($pieces[1] == 'jpg') {
              return imagesy(imagecreatefromjpeg($img));
         }elseif ($pieces[1] == 'jpeg') {
              return imagesy(imagecreatefromjpeg($img));
         }elseif ($pieces[1] == 'gif') {
              return imagesy(imagecreatefromgif($img));
         }

   }
     public function getWidth($img)
   {
         $pieces = explode(".",$img);
         if($pieces[1] == 'png')
         {
              return imagesx(imagecreatefrompng($img));
         }elseif ($pieces[1] == 'jpg') {
              return imagesx(imagecreatefromjpeg($img));
         }elseif ($pieces[1] == 'jpeg') {
              return imagesx(imagecreatefromjpeg($img));
         }elseif ($pieces[1] == 'gif') {
              return imagesx(imagecreatefromgif($img));
         }
   }


   public function setCount($subTitle)
   {
        $result = (new \yii\db\Query())
         ->from('image')
         ->where(['category' => $subTitle])->all();

        return count($result);
   }
   public function lastImageByDate($title)
   {

        $result = (new \yii\db\Query())
         ->from('image')
         ->where(['category' => $title])->max('date');

         $image = (new \yii\db\Query())
          ->from('image')
          ->where(['date' => $result])->one();
          if($image == '')
          {
               return 'default.png';
          }
        return $image['image'];
   }

   public function imgPath($id)
   {
        $category = CategoryModel::find()->where(['id' => $id])->one();
        $images = ImageModel::find()->where(['category' => $category->title])->one();

        $result = (new \yii\db\Query())
         ->from('image')
         ->where(['category' => $category->title])->max('date');

         $image = (new \yii\db\Query())
          ->from('image')
          ->where(['date' => $result])->one();

        if($images == null)
        {
             return '../../../modules/photo/web/images/photogallery/default.png';
        }else {
             return $image['image'];
        }
   }

   public function img_by_key($category_id)
   {
        $category = CategoryModel::find()->where(['id' => $category_id])->one();
        $images = ImageModel::find()->where(['category' => $category->title, 'key' => '1'])->one();
        if($images == null)
        {
             return '../../../modules/photo/web/images/photogallery/default.png';
        }else {
             return $images['image'];
        }
   }

}
