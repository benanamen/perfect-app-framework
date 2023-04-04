<?php

declare(strict_types=1);

namespace PerfectApp\Debug;

/**
 * Class ShowDebugData
 * @package PerfectApp\Debug
 */
class ShowDebugData
{
    /**
     * @param VarDumper $varDumper
     * @param array $var
     */

    public static function displayDebugData(VarDumper $varDumper, array $var): void
    {
        echo $varDumper->dump($var);
    }
}
