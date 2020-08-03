<?php use yii\widgets\LinkPager; use app\modules\photo\modules\admin\models\ImageUpload; ?>
<?php  $this->registerCssFile('/basic/modules/photo/web/css/categorystyle2.css');  ?>

<h1><b><?=$title?>:</b></h1>

<article class="main">
     <?php for($i = 0; $i < count($categories); $i++) { ?>
          <a href="/basic/web/page/category/<?=$categories[$i]['slug']?>/page/1">
               <section class="block">
                         <img src="<?php echo ( "/basic/modules/photo/web/images/photogallery/". ImageUpload::lastImageByDate($categories[$i]['title']) )?>" alt="img">
                         <div class="paragraph">
                              <p class="category-title"><?=$categories[$i]['title']?></p>
                              <p><b>(<?=ImageUpload::setCount($categories[$i]['title'])?>)</b></p>
                         </div>
               </section>
          </a>
     <?php } ?>
</article>

<?php
echo LinkPager::widget([
 'pagination' => $pagination,
 'class' => 'pagination',
]);
?>
