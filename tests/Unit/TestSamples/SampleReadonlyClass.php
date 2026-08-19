<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit\TestSamples;

readonly class SampleReadonlyClass
{
    public string $notPromoted;

    public function __construct(
        public ?string $nullablePromotedProperty,
        private ?string $nullablePrivatePromotedProperty,
        public mixed $mixedPromotedProperty,
        private ?string $privateNullableProperty,
        public string $noDefaultValue,
        public string $promotedProperty = 'promoted property default value',
        private string $privatePromotedProperty = 'private promoted property default value',
    ) {
    }

    private function privateMethod(): void
    {
        // Use the private property just to avoid the warning.
        echo $this->privatePromotedProperty;
        echo $this->privateNullableProperty;
        echo $this->nullablePrivatePromotedProperty;
    }
}
