<?php

namespace common\services;

use common\dto\NumbersDTO;

/**
 * Сервис для работы с суммами
 */
class SumService
{
    /**
     * Вычисляет сумму четных чисел
     * 
     * @param NumbersDTO $dto
     * @return int
     */
    public function sumNumbers(NumbersDTO $dto): int
    {
        $evenNumbers = array_filter($dto->numbers, function($num) {
            return $num % 2 == 0;
        });
        
        return array_sum($evenNumbers);
    }
}
