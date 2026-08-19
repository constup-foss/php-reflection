<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleReadonlyClass;
use Exception;

class PropertyHasDefaultValueDataProvider
{
    public static function provide_PromotedProperty_HappyFlow(): array
    {
        return [
            'Promoted property has default value.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'promotedProperty',
                'expected' => true,
            ],
            'Promoted property does not have default value.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'noDefaultValue',
                'expected' => false,
            ],
            'Private promoted property has default value.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'privatePromotedProperty',
                'expected' => true,
            ],
        ];
    }

    public static function provide_ClassProperty_HappyFlow(): array
    {
        return [
            'Class property has default value.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'publicClassProperty',
                'expected' => true,
            ],
            'Private class property has default value.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'privateClassProperty',
                'expected' => true,
            ],
            'Class property does not have default value.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'notNullableClassProperty',
                'expected' => false,
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Property does not exist. Exception should be thrown.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'non_existing_property',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "non_existing_property" does not exist.',
            ],
        ];
    }
}
