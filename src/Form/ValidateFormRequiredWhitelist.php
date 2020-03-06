<?php declare(strict_types=1);

namespace PerfectApp\Form;

/**
 * Class ValidateFormRequiredWhitelist
 */
Class ValidateFormRequiredWhitelist
{
    /**
     * @param array $whitelist
     * @param array $trimmedPostArray
     */
    final public function validateWhiteList(array $whitelist, array $trimmedPostArray): void
    {
        foreach ($trimmedPostArray as $key => $val)
        {
            if (!in_array($key, $whitelist, true))
            {
                die('Hack-Attempt Detected. Please use only the fields in the form');
            }
        }
    }

    /**
     * @param array $requiredFields
     * @param array $trimmedPostArray
     * @return array
     */
    final public function requiredFieldCheck(array $requiredFields, array $trimmedPostArray): array
    {
        $error = [];
        foreach ($requiredFields as $val)
        {
            if (empty($trimmedPostArray[$val]))
            {
                $msg = ucwords(str_replace('_', ' ', $val));
                $error[$val] = $msg . ' Required';
            }
        }
        return $error;
    }
}
