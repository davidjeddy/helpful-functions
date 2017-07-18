<?php
declare(strict_types=1);

namespace dje\components;

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
}
