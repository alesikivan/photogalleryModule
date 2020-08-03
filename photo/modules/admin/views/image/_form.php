<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ImageModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <label>Category:</label>
       <?= Html::dropDownList('category', 0, $categoryList, ['class' => 'form-control', 'id' => 'image-category']) ?>
       <br>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'image-title']) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <label id="press">Status:</label>
       <?= Html::dropDownList('status', 1, $statusList, ['class' => 'form-control', 'id' => 'status']) ?>
       <br>


    <?= $form->field($uploadModel, 'image')->fileInput(['maxlength' => true]) ?>

    <label>Watermark place:</label>
       <?= Html::dropDownList('watermark', 0, $waterList, ['class' => 'form-control', 'id' => 'watermark']) ?>
       <br>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php //$this->registerJsFile('@web/js/create.js', ['depends' => 'yii\web\YiiAsset',]) ?>
