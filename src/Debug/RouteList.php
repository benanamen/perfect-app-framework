<?php declare(strict_types=1);
// See Example: https://github.com/garygreen/pretty-routes

namespace PerfectApp\Debug;

/**
 * Class RouteList
 */
class RouteList
{
    public static function parseRoutes($routes): array
    {
        $result = [];
        foreach ($routes as $k => $v) {
            foreach ($v as $c => $d) {
                $pieces = explode('@', $d);
                $result[] = ['request' => $k, 'path' => $c, 'controller' => $pieces[0], 'method' => $pieces[1]];
            }
        }
        return $result;
    }
}
