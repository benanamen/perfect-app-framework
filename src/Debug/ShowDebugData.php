<?php declare(strict_types=1);

namespace PerfectApp\Debug;

/**
 * Class ShowDebugData
 * @package PerfectApp\Debug
 */
class ShowDebugData
{
    /**
     * @param HTMLVarDumper $varDumper
     * @param array|null $var
     */
    public static function displayDebugData(HTMLVarDumper $varDumper, array $var = null) :void
    {
        echo '<div class="danger"><H1>DEBUGGING IS ON !!!</H1></div>';
        $varDumper->dump($var);
    }
}
