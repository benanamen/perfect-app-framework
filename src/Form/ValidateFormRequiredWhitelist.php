<?php declare(strict_types=1);

namespace PerfectApp\Form;

/**
 * Class ValidateFormRequiredWhitelist
 */
Class ValidateFormRequiredWhitelist
{
    /**
     * @param array $whitelist
     * @param array $postArray
     */
    final public function validateWhiteList(array $whitelist, array $postArray): void
    {
        foreach ($postArray as $key => $val)
        {
            if (!in_array($key, $whitelist, true))
            {
                die('Hack-Attempt Detected. Please use only the fields in the form');
            }
        }
    }

    /**
     * @param array $requiredFields
     * @param array $postArray
     * @return array
     */
    final public function requiredFieldCheck(array $requiredFields, array $postArray): array
    {
        $error = [];
        foreach ($requiredFields as $val)
        {
            if (empty($postArray[$val]))
            {
                $msg = ucwords(str_replace('_', ' ', $val));
                $error[$val] = $msg . ' Required';
            }
        }
        return $error;
    }
}
