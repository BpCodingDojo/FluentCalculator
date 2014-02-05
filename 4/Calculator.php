<?php
/**
 * Created by PhpStorm.
 * User: csaba.madaras
 * Date: 2/5/14
 * Time: 5:47 PM
 */

class Calculator
{
    private $baseValue = null;
    private $operations = array();
    private $operationEndIndex = 0;

    public function calc($number)
    {
        if (!$this->isCalculatorInitialized())
        {
            $this->baseValue = $number;
        }

        return $this;
    }

    public function plus ($number)
    {
        if ($this->isCalculatorInitialized())
        {
            $this->operations[] = new Operation("plus", $number);
            $this->operationEndIndex++;
        }

        return $this;
    }

    public function minus ($number)
    {
        if ($this->isCalculatorInitialized())
        {
            $this->operations[] = new Operation("minus", $number);
            $this->operationEndIndex++;
        }

        return $this;
    }

    private function isCalculatorInitialized()
    {
        return !is_null($this->baseValue);
    }

    public function undo ()
    {
        $this->operationEndIndex--;
        return $this;
    }

    public function toInt()
    {
        $result = (int)$this->baseValue;
        for($i = 0; $i < $this->operationEndIndex; $i++)
        {
            $result = $this->operations[$i]->calc($result);
        }

        return (int)$result;
    }
}

class Operation
{
    private $operation;
    private $base;

    public function __construct($operation, $base)
    {
        $this->operation = $operation;
        $this->base = $base;
    }

    public function calc($value)
    {
        switch ($this->operation)
        {
            case "plus":
                return $value + $this->base;
            break;
            case "minus":
                return $value - $this->base;
            break;
        }
    }
}


