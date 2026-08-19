<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\TestSamples;

class SampleNonReadonlyClass
{
    public string $publicClassProperty = 'public class property default value';
    public ?string $nullableClassProperty;
    public mixed $mixedClassProperty;
    public string $notNullableClassProperty;
    private ?string $privateNullableClassProperty;
    private string $privateClassProperty = 'private class property default value';

    public function __construct(
        public string $promotedProperty = 'promoted property default value',
        private string $privatePromotedProperty = 'private promoted property default value'
    ) {
    }

    public function something(): void
    {
        echo $this->privatePromotedProperty;
    }
}
