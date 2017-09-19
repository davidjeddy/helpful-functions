<?php
declare(strict_types=1);

namespace dje;

/**
 * Class HelpfulFunctions
 *
 * @package davidjeddy/yii2-helpful-classes
 */
class HelpfulFunctions extends \yii\base\Component
{
    /**
     * @source https://stackoverflow.com/questions/7696548/php-how-to-remove-empty-entries-of-an-array-recursively
     * @param array $sourceArray
     * @return array
     */
    public static function removeEmptyArrayKeys(array $sourceArray): array
    {
        foreach ($sourceArray as $key => $value) {
            if (is_array($value)) {
                $sourceArray[$key] = self::removeEmptyArrayKeys($sourceArray[$key]);
            }

            if (empty($sourceArray[$key])) {
                unset($sourceArray[$key]);
            }
        }

        return $sourceArray;
    }

    /**
     * @source https://stackoverflow.com/questions/4790453/php-recursive-array-to-object
     * @param $array
     * @return \stdClass
     */
    public static function arrayToObject($array) {
        $obj = new \stdClass;

        foreach($array as $k => $v) {
            if(strlen($k)) {
                if(is_array($v)) {
                    $obj->{$k} = self::arrayToObject($v); //RECURSION
                } else {
                    $obj->{$k} = $v;
                }
            }
        }

        return $obj;
    }

    /**
     * Basically, convert 'jpeg' to 'jpg', all other file extensions are three letter already.
     *
     * @param string $fileName
     *
     * @return string
     */
    public static function sanitizeFileExt(string $fileName = null) : string
    {
        $returnData = explode('.', $fileName);
        $returnData = end($returnData);

        // remove query string from file extension
        if (strpos($returnData, '?') > 0) {
            $returnData = explode('?', $returnData)[0];
        }

        if ($returnData === 'jpeg') {
            $returnData = 'jpg';
        }

        return $returnData;
    }

    /**
     * @source http://stackoverflow.com/questions/5147691/return-all-array-elements-except-for-a-given-key
     * @param       $array
     * @param array $excludeKeys
     *
     * @return mixed
     */
    public static function arrayExclude($array, array $excludeKeys)
    {
        foreach ($excludeKeys as $key) {
            unset($array[$key]);
        }
        return $array;
    }

    /**
     * @param string $url
     * @param string $target
     * @return string
     * @throws \Exception
     */
    public static function curlGET(string $url, string $target = ''): string
    {
        $returnData = null;

        try {
            // exec basic curl request
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);

            if ($target !== '') {
                curl_setopt($curl, CURLOPT_FILE, $fp);
            }

            $returnData = curl_exec($curl);
            curl_close($curl);

            // save to file if provided
            if ($target !== '') {
                $fp = fopen($target, 'wb');
                fclose($fp);
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $returnData;
    }
}
