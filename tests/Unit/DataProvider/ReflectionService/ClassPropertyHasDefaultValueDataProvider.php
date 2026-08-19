<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService;

use ConstupFoss\PhpReflection\Tests\Unit\TestSamples\SampleNonReadonlyClass;

class ClassPropertyHasDefaultValueDataProvider
{
    public static function provide_HappyFlow(): array
    {
        return [
            'Class property has default value.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'publicClassProperty',
                'expected' => true,
            ],
            'Private class property has default value.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'privateClassProperty',
                'expected' => true,
            ],
            'Class property does not have default value.' => [
                'fqcn' => SampleNonReadonlyClass::class,
                'propertyName' => 'notNullableClassProperty',
                'expected' => false,
            ],
        ];
    }
}
