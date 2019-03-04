<?php declare(strict_types=1);

namespace PerfectApp\Debug;


/**
 * Class ShowDebugData
 * @package PerfectApp\Debug
 */
class ShowDebugData
{

    /**
     * @param array|null $var
     * @param HTMLVarDumper $varDumper
     */
    public static function displayDebugData(HTMLVarDumper $varDumper, array $var = null)
    {
        echo '<div class="error_custom"><H1>DEBUGGING IS ON !!!</H1></div>';

        if ($var)
        {
            foreach ($var as $title => $data)
            {
                $varDumper->dump($title, $data);
            }
        }
    }
}
