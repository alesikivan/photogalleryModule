
<?php   use yii\helpers\Html;?>
<?php use yii\widgets\LinkPager;  use  yii\helpers\Url;?>
<?php  //$this->registerCssFile('../modules/photo/web/css/main_category1.css');  ?>

<script>var categories = <?php if($pagination->totalCount != null){echo $pagination->totalCount;}else {
     echo 0;
} ?>;<?php  ?>
var title = "category";
var online;
 online = <?php if(isset($_GET['page'])){if($_GET['page'] !== null){echo $_GET['page'];}else{echo "0";}}else{echo "0";} ?>;
</script>
<h1><b>Categories:</b></h1>

<?php
echo LinkPager::widget([
 'pagination' => $pagination,
 'class' => 'pagination',
]);
?>


<article class="category grid" id="grid">

     <?php for($i = 0; $i < count($categories); $i++){ ?>

          <div class="block grid-item">
               <a href="<?=Url::to(["category/index", 'slug' => $categories[$i]['slug']]) ?>" class="link">
                    <img src="<?php echo Yii::getAlias('@web/images/photogallery/' . $path[$i])?>" alt="Картинка">
                    <div class="info">
                              <span id="category-title"><?=$categories[$i]['title']?> (<?=$img_count[$i]?>)</span>
                    </div>
               </a>
          </div>

     <?php } ?>

</article>

<?php  //$this->registerJsFile('../modules/photo/web/js/infinite-scroll.pkgd.min.js');?>
<?php  //$this->registerJsFile('../modules/photo/web/js/masonry.pkgd.min.js');?>
<?php  //$this->registerJsFile('../modules/photo/web/js/masonry_test.js');?>
