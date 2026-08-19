<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleNonReadonlyClass;
use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleReadonlyClass;
use Exception;

class GetPromotedPropertyDefaultValueDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Property has default value. Readonly class. Public property. Default value should be returned.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'promotedProperty',
                'expected' => 'promoted property default value',
            ],
            'Property has default value. Readonly class. Private property. Default value should be returned.' => [
                'fqcn' => SampleReadonlyClass::class,
                'propertyName' => 'privatePromotedProperty',
                'expected' => 'private promoted property default value',
            ],
            'Property has default value. Not a readonly class. Default value should be returned.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'promotedProperty',
                'expected' => 'promoted property default value',
            ],
        ];
    }

    public static function provide_ErrorFlow(): array
    {
        return [
            'Class does not exist. Exception should be thrown.' => [
                'fqcn' => 'NonExistingClass',
                'propertyName' => 'promotedProperty',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Class "NonExistingClass" does not exist',
            ],
            'Property does not exist. Exception should be thrown.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'non_existing_property',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "non_existing_property" is either not promoted, does not exist, or has no default value.',
            ],
            'Property exists, but has no default value. Exception should be thrown.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'noDefaultValue',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "noDefaultValue" is either not promoted, does not exist, or has no default value.',
            ],
            'Property exists, but is not promoted. Exception should be thrown.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'notPromoted',
                'expectedException' => Exception::class,
                'expectedExceptionMessage' => 'Property "notPromoted" is either not promoted, does not exist, or has no default value.',
            ],
        ];
    }
}
