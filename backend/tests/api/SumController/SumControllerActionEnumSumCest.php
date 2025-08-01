<?php

namespace api\SumController;

use backend\tests\UnitTester;

class SumControllerActionEnumSumCest
{
    public string $url = 'api/sum/even-sum';

    public array $successData = [];

    public function _before(UnitTester $I)
    {
        $this->successData = ['numbers' => [1, 2, 3, 4, 5, 6]];
    }

    /**
     * @group api
     * @group api-sum
     * @group api-sum-controller
     * @group api-sum-controller-action-enum-sum
     * @group api-sum-controller-action-enum-sum-success
     */
    public function testSuccess(UnitTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->send('post', $this->url, $this->successData);
        $I->seeResponseCodeIsSuccessful();
        $I->canSeeResponseIsJson();

        $I->seeResponseContainsJson([
            'sum' => 12,
        ]);
    }

    /**
     * @group api
     * @group api-sum
     * @group api-sum-controller
     * @group api-sum-controller-action-enum-sum
     * @group api-sum-controller-action-enum-sum-numbers-required
     */
    public function testNumbersRequired(UnitTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->send('post', $this->url, []);
        $I->seeResponseCodeIs(400);
        $I->seeResponseContainsJson([
            'errors' => [
                'numbers' => ['Numbers cannot be blank.'],
            ],
            'status' => 'error',
            'code' => 400
        ]);
    }

    /**
     * @group api
     * @group api-sum
     * @group api-sum-controller
     * @group api-sum-controller-action-enum-sum
     * @group api-sum-controller-action-enum-sum-numbers-array
     */
    public function testNumbersArray(UnitTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->send('post', $this->url, ['numbers' => 'not an array']);
        $I->seeResponseCodeIs(400);
        $I->seeResponseContainsJson([
            'errors' => [
                'numbers' => ['Numbers must be an array.'],
            ],
            'status' => 'error',
            'code' => 400
        ]);
    }

    /**
     * @group api
     * @group api-sum
     * @group api-sum-controller
     * @group api-sum-controller-action-enum-sum
     * @group api-sum-controller-action-enum-sum-numbers-array-integer
     */
    public function testNumbersArrayInteger(UnitTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->send('post', $this->url, ['numbers' => [1, 2, "3", 4]]);
        $I->seeResponseCodeIs(400);
        $I->seeResponseContainsJson([
            'errors' => [
                'numbers' => ['Each number must be a strict integer.'],
            ],
            'status' => 'error',
            'code' => 400
        ]);
    }
}
