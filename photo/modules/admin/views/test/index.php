<?php use yii\helpers\Html; use yii\widgets\ActiveForm;?>
<?php $this->registerCssFile('@web/css/full.css', ['depends' => 'yii\web\YiiAsset']) ?>

<style media="screen">

</style>

<!-- The overlay -->
<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <!-- Overlay content -->
  <div class="overlay-content">
	  <?= Html::a('Удалить все фото', ['delete', 'id' => '1'], [
                         'class' => 'after',
                         'data' => [
                         'confirm' => 'Are you sure you want to delete this item?',
                         'method' => 'post',
                          ],
				 ]); ?>
				 <div class="line"></div>

				<?php $form = ActiveForm::begin(['class' => 'main-form']); ?>
					<?= Html::dropDownList('category', 0, ['Animal' => 'Animal', 2 => 'Family'], ['class' => 'select-tag']) ?>
					<?= Html::submitButton('Move', ['class' => 'myBtn']) ?>
				<?php ActiveForm::end(); ?>
  </div>

</div>

<!-- Use any element to open/show the overlay navigation menu -->
<span onclick="openNav()" class="delete" id="Animal">Delete</span>
<span onclick="openNav()" class="delete" id="Space">Delete</span>
<span onclick="openNav()" class="delete" id="Family">Delete</span>


<?php $this->registerJsFile('@web/js/fullScreen.js', ['depends' => 'yii\web\YiiAsset']) ?>
