<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleReadonlyClass;
use Exception;

class IsPromotedPropertyNullableDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Promoted property is nullable.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'nullablePromotedProperty',
                'expected' => true,
            ],
            'Promoted property is not nullable.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'noDefaultValue',
                'expected' => false,
            ],
            'Promoted property is mixed type.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'mixedPromotedProperty',
                'expected' => true,
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Class does not exist. Exception should be thrown.' => [
                'fqcn' => 'NonExistentClass',
                'propertyName' => 'nonExistentProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Class "NonExistentClass" does not exist',
            ],
            'Property does not exist. Exception should be thrown.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'nonExistentProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "nonExistentProperty" is either not promoted or does not exist.',
            ],
            'Property is not promoted. Exception should be thrown.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'publicClassProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "publicClassProperty" is either not promoted or does not exist.',
            ],
        ];
    }
}
