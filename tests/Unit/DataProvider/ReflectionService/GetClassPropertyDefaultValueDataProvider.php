<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleNonReadonlyClass;
use Exception;

class GetClassPropertyDefaultValueDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Property has default value. Non-readonly class. Public property. Default value should be returned.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'publicClassProperty',
                'expected' => 'public class property default value',
            ],
            'Property has default value. Non-readonly class. Private property. Default value should be returned.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'privateClassProperty',
                'expected' => 'private class property default value',
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Class does not exist. Exception should be thrown.' => [
                'fqcn' => 'NonExistingClass',
                'propertyName' => 'publicClassProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Class "NonExistingClass" does not exist',
            ],
            'Property does not exist. Exception should be thrown.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'non_existing_property',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "non_existing_property" either does not exist or has no default value.',
            ],
            'Property is promoted, not a regular class property. Exception should be thrown.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'promotedProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "promotedProperty" either does not exist or has no default value.',
            ],
        ];
    }
}
