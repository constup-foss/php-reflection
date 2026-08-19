<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleNonReadonlyClass;
use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleReadonlyClass;
use Exception;

class IsPropertyNullableDataProvider
{
    public static function provide_PromotedProperty_HappyFlow(): array
    {
        return [
            'Promoted property is nullable.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'nullablePromotedProperty',
                'expected' => true,
            ],
            'Promoted property is mixed type.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'mixedPromotedProperty',
                'expected' => true,
            ],
            'Promoted property is not nullable.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'noDefaultValue',
                'expected' => false,
            ],
            'Private promoted property is nullable.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'privateNullablePromotedProperty',
                'expected' => true,
            ],
        ];
    }

    public static function provide_ClassProperty_HappyFlow(): array
    {
        return [
            'Class property is nullable.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'nullableClassProperty',
                'expected' => true,
            ],
            'Class property is mixed type.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'mixedClassProperty',
                'expected' => true,
            ],
            'Class property is not nullable.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'notNullableClassProperty',
                'expected' => false,
            ],
            'Private class property is nullable.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'privateNullableClassProperty',
                'expected' => true,
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Property does not exist. Exception should be thrown.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'non_existing_property',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "non_existing_property" does not exist.',
            ],
        ];
    }
}
