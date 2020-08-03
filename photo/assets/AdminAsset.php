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
class AdminAsset extends AssetBundle
{
     public function init()
     {
         parent::init();
         $this->sourcePath = '@app/modules/photo/web';
     }

    public $css = [
          // '../../../modules/photo/web/css/main_category1.css',''
          'css/site.css',
          'css/imageview.css',
          'css/full2.css',

    ];
    public $js = [
         'js/alertJs.js',
         'js/addmyclass.js',
         // 'js/fullScript2.js',
         'js/fullScript3.js',
         'js/test2.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
