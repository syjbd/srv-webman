<?php
/**
 * @desc BaseEnum.php
 * @auhtor Wayne
 * @time 2025/1/8 上午11:47
 */
namespace app;

class BaseEnum{

    public static function isValidValue($value): bool
    {
        $values = self::getValues();
        return in_array($value,$values, true);
    }

    public static function getValues(): array
    {
        $reflectionClass = new \ReflectionClass(self::class);
        return $reflectionClass->getConstants();
    }
}