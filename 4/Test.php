<?php
/**
 * Created by PhpStorm.
 * User: csaba.madaras
 * Date: 2/5/14
 * Time: 5:43 PM
 */
require('./Calculator.php');

class Test extends PHPUnit_Framework_TestCase {

    public function testCalc_Perfect_Perfect()
    {
        // Arrange
        $calc = new Calculator();

        // Act
        $result = $calc->calc(10)->toInt();

        // Assert
        $this->assertEquals(10, $result);
    }

    public function testCalc_CalcInvokedTwoTime_OnlyTheFirstInvocationTakesEffect()
    {
        // Arrange
        $calc = new Calculator();

        // Act
        $result = $calc->calc(10)->calc(15)->toInt();

        // Assert
        $this->assertEquals(10, $result);
    }

    public function testCalc_PlusFunctionInvoked_AddToBaseValue()
    {
        // Arrange
        $calc = new Calculator();

        // Act
        $result = $calc->calc(10)->plus(15)->toInt();

        // Assert
        $this->assertEquals(25, $result);
    }

    public function testCalc_MinusFunctionInvokedWithoutInitialization_SubstractFromBaseValue()
    {
        // Arrange
        $calc = new Calculator();

        // Act
        $result = $calc->minus(15)->toInt();

        // Assert
        $this->assertTrue($result === 0);
    }

    public function testCalc_MinusFunctionInvokedWithInitialization_SubstractFromBaseValue()
    {
        // Arrange
        $calc = new Calculator();

        // Act
        $result = $calc->calc(20)->minus(15)->toInt();

        // Assert
        $this->assertEquals(5, $result);
    }

    public function testCalc_UndoFunctionInvokedWithInitialization_UndoThePreviousInvocation()
    {
        // Arrange
        $calc = new Calculator();

        // Act
        $result = $calc->calc(20)->minus(15)->undo()->toInt();

        // Assert
        $this->assertEquals(20, $result);
    }

}
 