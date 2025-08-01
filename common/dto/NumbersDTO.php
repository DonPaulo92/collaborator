<?php

namespace common\dto;

use yii\base\Arrayable;

/**
 * DTO для передачи данных с числами
 */
class NumbersDTO implements Arrayable
{
    public array $numbers;

    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ['numbers'];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return $this->fields();
    }
}