<?php
declare(strict_types=1);

namespace dje\components;

/**
 * Class Resutoran
 *
 * @package dje\components
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
}
