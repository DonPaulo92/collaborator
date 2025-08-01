<?php

namespace backend\api;

use Yii;
use yii\base\Module as ApiModule;

/**
 * API модуль
 */
class Module extends ApiModule
{
    public $controllerNamespace = 'backend\api\controllers';

    public function init()
    {
        parent::init();

        Yii::$app->user->enableSession = false;
        Yii::$app->user->enableAutoLogin = false;
    }
}
