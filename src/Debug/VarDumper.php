<?php

declare(strict_types=1);

namespace PerfectApp\Debug;

/**
 * A debug tool to print the content of variables (e. g. $_POST)
 */

/**
 * Interface VarDumper
 * @package PerfectApp\Debug
 */
interface VarDumper
{
    /**
     * @param array $data
     * @return string
     */
    public function dump(array $data): string;
}
