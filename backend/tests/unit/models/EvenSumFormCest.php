<?php

namespace backend\tests\unit\models;

use backend\models\Sum\forms\EvenSumForm;
use backend\tests\UnitTester;

class EvenSumFormCest
{
    public array $successData = [];
    public function _before(UnitTester $I)
    {
        $this->successData = ['numbers' => [1, 2, 3, 4, 5, 6]];
    }

    /**
     * @group unit
     * @group unit-models
     * @group unit-models
     * @group unit-models-even-sum
     * @group unit-models-even-sum-form
     * @group unit-models-even-sum-form-success
     */
    public function testSuccess(UnitTester $I)
    {
        $form = new EvenSumForm($this->successData);
        $I->assertTrue($form->validate());
    }

    /**
     * @group unit
     * @group unit-models
     * @group unit-models
     * @group unit-models-even-sum
     * @group unit-models-even-sum-form
     * @group unit-models-even-sum-form-numbers-required
     */
    public function testNumbersRequired(UnitTester $I)
    {
        $form = new EvenSumForm([]);
        $I->assertFalse($form->validate());

        $I->assertArrayHasKey('numbers', $form->getErrors());

        $I->assertContains('Numbers cannot be blank.', $form->getErrors()['numbers']);
    }

    /**
     * @group unit
     * @group unit-models
     * @group unit-models
     * @group unit-models-even-sum
     * @group unit-models-even-sum-form
     * @group unit-models-even-sum-form-numbers-array
     */
    public function testNumbersArray(UnitTester $I)
    {
        $form = new EvenSumForm(['numbers' => "smth"]);
        $I->assertFalse($form->validate());

        $I->assertArrayHasKey('numbers', $form->getErrors());

        $I->assertContains('Numbers must be an array.', $form->getErrors()['numbers']);
    }

    /**
     * @group unit
     * @group unit-models
     * @group unit-models
     * @group unit-models-even-sum
     * @group unit-models-even-sum-form
     * @group unit-models-even-sum-form-numbers-integer
     */
    public function testNumbersInteger(UnitTester $I)
    {
        $form = new EvenSumForm(['numbers' => [1,2,3, "smt"]]);
        $I->assertFalse($form->validate());

        $I->assertArrayHasKey('numbers', $form->getErrors());

        $I->assertContains('Each number must be a strict integer.', $form->getErrors()['numbers']);
    }
}