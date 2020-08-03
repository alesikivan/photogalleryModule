<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\ImageUpload;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ImageModel */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="image-model-form">


    <?php $form = ActiveForm::begin(['id' => 'image']); ?>



    <label>Category:</label>
       <?= Html::dropDownList('category', $selectCategory, $categoryList, ['class' => 'form-control', 'id' => 'image-category']) ?>
       <br>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'image-title']) ?>


    <label>Status:</label>
       <?= Html::dropDownList('status', $selectStatus, $statusList, ['class' => 'form-control', 'id' => 'status']) ?>
       <br>


    <?php //$form->field($uploadModel, 'image')->fileInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
