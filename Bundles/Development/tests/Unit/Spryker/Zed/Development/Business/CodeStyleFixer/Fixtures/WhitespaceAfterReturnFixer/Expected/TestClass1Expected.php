<?php

namespace Unit\Spryker\Zed\Development\Business\CodeStyleFixer\Fixtures\RemoveWrongWhitespaceFixer\Input;

class TestClass1Input
{

    public function replaceFunction()
    {
        return;
    }

    public function replaceFunctionB()
    {
        return $foo;
    }

    public function replaceFunctionC()
    {
        return ($foo + $bar);
    }

    public function doNotReplaceFunction()
    {
        return
            ($x + $y);
    }

}