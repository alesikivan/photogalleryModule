<?php use yii\widgets\LinkPager; use yii\helpers\Url; use yii\web\NotFoundHttpException; ?>
<?php if ($title == 'Error') {
     throw new NotFoundHttpException('Категория пуста');
} ?>
<h1 style="color:red">Листайте вниз</h1>
<h1><b><?=$title?>:</b></h1>
<?php
echo LinkPager::widget([
 'pagination' => $pagination,
 'class' => 'pagination',
]);
?>

<script>
var online;
 online = <?php if(isset($_GET['page'])){if($_GET['page'] !== null){echo $_GET['page'];}else{echo "0";}}else{echo "0";} ?>;
var categoryName = "<?php if($categoryTitle != null){echo $categoryTitle;}else{ echo "name";}?>";
var title = "photo";
var categories = <?php if($pagination->totalCount != null){echo $pagination->totalCount;}else {
     echo 0;
} ?>;<?php  ?></script>

<style media="screen">
</style>
<script>
     var loops = <?=$pageSize?>;
</script>
<?php  //$this->registerCssFile('../basic/../../../modules/photo/web/css/baguetteBox.css');  ?>
<?php  //$this->registerCssFile('../basic/../../../modules/photo/web/css/img.css');  ?>





<article class="baguetteBoxOne category grid" id="grid" onmouseover="update()">

     <?php for($i = 0; $i < count($images); $i++){ ?>

          <div class="block grid-item">
               <a href="<?php echo Yii::getAlias('@web/images/photogallery/' . $images[$i]['image'])?>" title="<?php echo (  $images[$i]['title'])?>">
                    <img src="<?php echo Yii::getAlias('@web/images/photogallery/' . $images[$i]['image'])?>" alt="<?php echo ( $images[$i]['title'])?>" class="small-image">
              </a>
          </div>

     <?php } ?>

</article>




<?php  //$this->registerJsFile('../basic/../../../modules/photo/web/js/highlight.min.js');  ?>
<?php  //$this->registerJsFile('../basic/../../../modules/photo/web/js/baguetteBox.js');  ?>

<script>
window.onload = function()
{
     (function() {
         baguetteBox.run('.baguetteBoxOne');
    })();
};
</script>
