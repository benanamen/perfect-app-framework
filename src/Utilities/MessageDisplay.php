<?php declare(strict_types=1);

namespace PerfectApp\Utilities;

/**
 * Interface MessageDisplay
 * @package PerfectApp\Utilities
 */
interface MessageDisplay
{
    /**
     * @param string $action
     * @return string
     */
    public function render(string $action): string;
}
