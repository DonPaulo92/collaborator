<?php

namespace backend\models\Sum\forms;

use yii\base\Model;

class EvenSumForm extends Model
{
    public const SCENARIO_FORM = 'sum_event_sum';

    public $numbers;

    public function init(): void
    {
        parent::init();
        $this->setScenario(self::SCENARIO_FORM);
    }

    public function rules(): array
    {
        return
            [
                [
                    'numbers',
                    'required',
                    'message' => 'Numbers cannot be blank.',
                    'on' => self::SCENARIO_FORM,
                ],
                [
                    'numbers',
                    function ($attribute, $params, $validator) {
                        if (!is_array($this->$attribute)) {
                            $this->addError($attribute, $validator->message);
                        }
                    },
                    'message' => 'Numbers must be an array.',
                    'on' => self::SCENARIO_FORM,
                ],
                [
                    'numbers',
                    'validateStrictIntegers',
                    'message' => 'Each number must be a strict integer.',
                    'on' => self::SCENARIO_FORM,
                ],
            ];
    }

    public function validateStrictIntegers($attribute, $params, $validator)
    {
        foreach ($this->$attribute as $value) {
            if (!is_int($value)) {
                $this->addError($attribute, $validator->message);
            }
        }
    }
}
