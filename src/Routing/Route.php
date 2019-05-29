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
    private $allowedFiles = [];

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
    public function getPage()
    {
        $pageBaseName = basename($this->page);

        if (in_array($pageBaseName, $this->allowedFiles) && file_exists($this->includePath . $pageBaseName . '.php'))
        {
            return $pageBaseName . '.php';
        }

        http_response_code(404);
        return '404.php';
    }
}
