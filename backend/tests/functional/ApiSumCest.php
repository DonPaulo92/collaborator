<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use Codeception\Util\HttpCode;

/**
 * Тестирование API для вычисления суммы четных чисел
 */
class ApiSumCest
{
    /**
     * Тест успешного вычисления суммы четных чисел
     */
    public function testEvenSumSuccess(FunctionalTester $I)
    {
        $I->sendPOST('/api/sum-even', [
            'numbers' => [1, 2, 3, 4, 5, 6]
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'sum' => 12
        ]);
    }

    /**
     * Тест с пустым массивом
     */
    public function testEvenSumEmptyArray(FunctionalTester $I)
    {
        $I->sendPOST('/api/sum-even', [
            'numbers' => []
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'sum' => 0
        ]);
    }

    /**
     * Тест с массивом без четных чисел
     */
    public function testEvenSumNoEvenNumbers(FunctionalTester $I)
    {
        $I->sendPOST('/api/sum-even', [
            'numbers' => [1, 3, 5, 7, 9]
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'sum' => 0
        ]);
    }

    /**
     * Тест валидации - неверный тип данных
     */
    public function testEvenSumValidationError(FunctionalTester $I)
    {
        $I->sendPOST('/api/sum-even', [
            'numbers' => [1, 'abc', 3]
        ]);

        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'status' => 'error'
        ]);
    }

    /**
     * Тест валидации - отсутствует поле numbers
     */
    public function testEvenSumMissingNumbers(FunctionalTester $I)
    {
        $I->sendPOST('/api/sum-even', []);

        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'status' => 'error'
        ]);
    }

    /**
     * Тест с большим массивом чисел
     */
    public function testEvenSumLargeArray(FunctionalTester $I)
    {
        $numbers = range(1, 100);
        $expectedSum = array_sum(array_filter($numbers, function($n) {
            return $n % 2 == 0;
        }));

        $I->sendPOST('/api/sum-even', [
            'numbers' => $numbers
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'sum' => $expectedSum
        ]);
    }
} 