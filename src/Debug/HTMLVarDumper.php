<?php

declare(strict_types=1);

namespace PerfectApp\Debug;

/**
 * Class HTMLVarDumper
 * @package PerfectApp\Debug
 */
class HTMLVarDumper implements VarDumper
{
    /**
     * @param array $data
     * @return string
     */
    final public function dump(array $data): string
    {
        $output = "<div class='danger'><H1>DEBUGGING IS ON !!!</H1></div>";
        foreach ($data as $k => $v) {
            foreach ($v as $k2 => $v2) {
                if ($k2) {
                    $output .= "<b><span style='color:#ff0000;'>$k</span></b><pre><b>" . print_r($v, true) . "</b></pre>";
                }
            }
        }
        return $output;
    }
}
