<?php

namespace backend\tests\unit\services;

use backend\tests\UnitTester;
use common\dto\NumbersDTO;
use common\services\SumService;

class SumServiceCest
{
    private SumService $service;
    public function _before()
    {
        $this->service = new SumService();
    }

    /**
     * @group unit
     * @group unit-services
     * @group unit-services-sum-service
     * @group unit-services-sum-service-success
     */
    public function testSuccess(UnitTester $I)
    {
        $dto = new NumbersDTO(['numbers' => [1, 2, 3, 4, 5, 6]]);
        $expected = 12;
        $actual = $this->service->sumNumbers($dto);

        $I->assertEquals($expected, $actual);
    }
}
