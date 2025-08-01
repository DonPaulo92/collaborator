<?php

namespace common\interfaces;

use common\dto\NumbersDTO;
interface SumInterface
{
    public function sumNumbers(NumbersDTO $dto): int;
}
