<?php declare(strict_types=1);

namespace PerfectApp\Form;

use Exception;

/**
 * Class ValidateFormRequiredWhitelist
 */
class ValidateFormRequiredWhitelist
{
    /**
     * @param  array  $whitelist
     * @param  array  $postArray
     *
     * @throws Exception
     */
    final public function validateWhiteList(array $whitelist, array $postArray): void
    {
        foreach ($postArray as $key => $val)
        {
            if (!in_array($key, $whitelist, true))
            {
                $message = 'Hack-Attempt Detected. Please use only the fields in the form.';
                echo "<h1>$message</h1>";
                throw new Exception($message);
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
