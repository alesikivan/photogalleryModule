<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\photo\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyAsset extends AssetBundle
{
     public function init()
     {
         parent::init();
         $this->sourcePath = '@app/modules/photo/web';
     }

    public $css = [
          // '../../../modules/photo/web/css/main_category1.css',''
          'css/site.css',
          'css/baguetteBox.css',
          'css/img.css',
          'css/toDay.css',

    ];
    public $js = [
         'js/highlight.min.js',
         'js/baguetteBox.js',
         'js/infinite-scroll.pkgd.min.js',
         'js/alertJs.js',
         'js/masonry.pkgd.min.js',
         'js/masonry_test_2.js',
         'js/masonry_test_final.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
