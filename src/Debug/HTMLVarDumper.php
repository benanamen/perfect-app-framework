<?php declare(strict_types=1);

namespace PerfectApp\Debug;

/**
 * Class HTMLVarDumper
 * @package PerfectApp\Debug
 */
class HTMLVarDumper
{
    /**
     * @param array $data
     */
    final public function dump(array $data): void
    {
        echo '<span style="color:red;font-weight:bold">';

        foreach ($data as $k => $v)
        {
            foreach ($v as $k2 => $v2)
            {
                if ($k2)
                {
                    echo $k . '<pre>', print_r($v2, true), '</pre>';
                }
            }
        }
        echo '</span>';
    }
}
