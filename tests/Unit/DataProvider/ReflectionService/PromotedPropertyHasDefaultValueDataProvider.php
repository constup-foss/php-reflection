<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleReadonlyClass;

class PromotedPropertyHasDefaultValueDataProvider
{
    public static function provide_HappyFlow(): array
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
}
