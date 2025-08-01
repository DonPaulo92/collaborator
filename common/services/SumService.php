<?php

namespace common\services;

use common\dto\NumbersDTO;
use common\interfaces\SumInterface;

class SumService implements SumInterface
{
    public function sumNumbers(NumbersDTO $dto): int
    {
        $evenNumbers = array_filter($dto->numbers, function($num) {
            return $num % 2 == 0;
        });
        
        return array_sum($evenNumbers);
    }
}
