<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CategoryModel */
/* @var $form yii\widgets\ActiveForm */
?>
<!-- <?php //$this->registerJsFile('@web/js/imagereg2.js', ['depends' => 'yii\web\YiiAsset']) ?> -->

<div class="category-model-form">

    <?php $form = ActiveForm::begin(['id' => 'category']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'category-title']) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true,  'id' => 'category-slug']) ?>

    <label>Status:</label>
    <?= Html::dropDownList('status', $selectItem, $statusList, ['class' => 'form-control', 'id' => 'category-status']) ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
