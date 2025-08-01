<?php

namespace backend\api\controllers;

use backend\models\Sum\forms\EventSumForm;
use common\dto\NumbersDTO;
use common\services\SumService;
use Yii;

class SumController extends BaseController
{
    public function actionEvenSum()
    {
        $post = Yii::$app->request->post();
        $form = new EventSumForm();
        $form->load($post, '');

        if (!$form->validate()) {
            return $this->error($form->getErrors());
        }

        $dto = new NumbersDTO(['numbers' => $form->numbers]);

        $service = new SumService();
        $sum = $service->sumNumbers($dto);

        return $this->success(['sum' => $sum]);
    }
}
