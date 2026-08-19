<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleNonReadonlyClass;
use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleReadonlyClass;
use Exception;

class GetPropertyDefaultValueDataProvider
{
    public static function provide_PromotedPropertyHasDefault_HappyFlow(): array
    {
        return [
            'Promoted property has default value.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'promotedProperty',
                'expected' => 'promoted property default value',
            ],
        ];
    }

    public static function provide_ClassPropertyHasDefault_HappyFlow(): array
    {
        return [
            'Class property has default value.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'publicClassProperty',
                'expected' => 'public class property default value',
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
                'expectedExceptionMessage' => 'Property "non_existing_property" does not exist or does not have a default value.',
            ],
            'Property does not have a default value. Exception should be thrown.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'mixedProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "mixedProperty" does not exist or does not have a default value.',
            ],
        ];
    }
}
