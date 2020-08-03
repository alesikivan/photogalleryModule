<?php

namespace app\modules\photo;

/**
 * photo module definition class
 */
class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\photo\controllers';

    /**
     * {@inheritdoc}
     */


    public function init()
    {
         parent::init();

         $this->modules = [
            'bootstrap' => 'photo',
            'admin' => [
                'class' => 'app\modules\photo\modules\admin\Module',
            ],
            'pictures' => [
                'class' => 'app\modules\photo\modules\pictures\Module',
            ],
        ];
        // var_dump($this->modules['admin']);die;
    }

    public function bootstrap($app)
    {
         $app->getUrlManager()->enablePrettyUrl = true;
         $app->getUrlManager()->showScriptName = false;


         $app->getUrlManager()->addRules([
              'about' => 'site/about',


              '/page/category/<slug:[a-zA-Z0-9_-]+>/page/<page:\d+>' => '/photo/pictures/category/index',
              '/page/category/<slug:[a-zA-Z0-9_-]+>' => '/photo/pictures/category/index',

              '/' => '/photo/pictures',
              '/page/<page:\d+>' => 'photo/pictures/default/index',

         ], false);
    }

}
