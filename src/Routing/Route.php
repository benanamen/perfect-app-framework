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
     * @var array
     */
    private $standardFiles = [];

    /**
     * Route constructor.
     * @param string $page
     * @param array $standardFiles
     * @param array $allowedFiles
     * @param string $includePath
     */
    public function __construct(string $page, array $standardFiles, array $allowedFiles, string $includePath)
    {
        $this->page = $page;
        $this->includePath = $includePath;
        $this->allowedFiles = $allowedFiles;
        $this->standardFiles = $standardFiles;
    }

    /**
     * @return mixed|string
     */
    public function getPage(): string
    {
        if ($this->page)
        {
            $pageBaseName = basename($this->page);

            if (in_array($pageBaseName, $this->allowedFiles) && file_exists($this->includePath . $pageBaseName . '.php'))
            {
                return $pageBaseName . '.php';
            }
            return $this->standardFiles['404'];
        }
        return $this->standardFiles['default'];
    }
}
