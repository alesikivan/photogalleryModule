<?php

namespace app\modules\photo\modules\pictures;

/**
 * pictures module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\photo\modules\pictures\controllers';
    public $layout = 'main';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
