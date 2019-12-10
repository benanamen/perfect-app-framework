<?php declare(strict_types=1);

namespace PerfectApp\Routing;

/**
 * Class Route
 * @package PerfectApp\Routing
 */
class Route
{
    /**
     * @var string
     */
    private $page;

    /**
     * @var string
     */
    private $includePath;
    /**
     * @var array
     */
    private $allowedFiles;

    /**
     * Route constructor.
     * @param string $page
     * @param array $allowedFiles
     * @param string $includePath
     */
    public function __construct(string $page, array $allowedFiles, string $includePath)
    {
        $this->page = $page;
        $this->includePath = $includePath;
        $this->allowedFiles = $allowedFiles;
    }

    /**
     * @return string
     */
    final public function getPage(): string
    {
        $pageBaseName = basename($this->page);

        if (is_readable($this->includePath . $pageBaseName . '.php'))
        {
            if (in_array($pageBaseName, $this->allowedFiles, true))
            {
                return $this->includePath . $pageBaseName . '.php';
            }
            http_response_code(403);
            return $this->includePath . '403-2.php';
        }
        http_response_code(404);
        return $this->includePath . '404-3.php';
    }
}
