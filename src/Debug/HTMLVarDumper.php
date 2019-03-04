<?php declare(strict_types=1);

namespace PerfectApp\Debug;

/**
 * Class HTMLVarDumper
 * @package PerfectApp\Debug
 */
class HTMLVarDumper implements VarDumper
{

    /**
     * @param string $title
     * @param array $data
     * @return mixed|void
     */
    public function dump(string $title, array $data)
    {
        echo '<pre><span style="color:red;font-weight:bold">';
        echo $title . '<br>';
        print_r($data);
        echo '</span></pre>';
    }
}
