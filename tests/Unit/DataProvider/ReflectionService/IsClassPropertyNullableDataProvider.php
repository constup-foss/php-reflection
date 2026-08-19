<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleNonReadonlyClass;
use Exception;

class IsClassPropertyNullableDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Property is nullable.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'nullableClassProperty',
                'expected' => true,
            ],
            'Property is not nullable.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'notNullableClassProperty',
                'expected' => false,
            ],
            'Private property is nullable.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'privateNullableClassProperty',
                'expected' => true,
            ],
            'Property is mixed type.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'mixedClassProperty',
                'expected' => true,
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Class does not exist. Exception should be thrown.' => [
                'fqcn' => 'NonExistingClass',
                'propertyName' => 'nullableClassProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Class "NonExistingClass" does not exist',
            ],
            'Property does not exist. Exception should be thrown.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'nonExistingProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "nonExistingProperty" does not exist or is promoted.',
            ],
            'Property is promoted, not a regular class property. Exception should be thrown.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'promotedProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "promotedProperty" does not exist or is promoted.',
            ],
        ];
    }
}
