<?php declare(strict_types=1);

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
     *  Prints a value
     *
     * @param string $title the title to be printed
     * @param array $data the value
     * @return mixed
     */
    public function dump(string $title, array $data): array;
}
