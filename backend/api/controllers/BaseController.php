<?php

namespace backend\api\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    protected function success($data = null)
    {
        return $data;
    }

    protected function error($message = 'Error', $code = 400)
    {
        Yii::$app->response->statusCode = $code;
        if (is_array($message)) {
            return [
                'status' => 'error',
                'errors' => $message,
                'code' => $code,
            ];
        }
        
        return [
            'status' => 'error',
            'message' => $message,
            'code' => $code,
        ];
    }
}
