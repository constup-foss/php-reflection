<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection;

use Exception;
use ReflectionClass;
use ReflectionException;
use Throwable;

readonly class ReflectionService implements ReflectionServiceInterface
{
    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function propertyHasDefaultValue(string $fqcn, string $propertyName): bool
    {
        try {
            return $this->promotedPropertyHasDefaultValue($fqcn, $propertyName);
        } catch (Throwable) {
            try {
                return $this->classPropertyHasDefaultValue($fqcn, $propertyName);
            } catch (Throwable) {
                throw new Exception('Property "' . $propertyName . '" does not exist.');
            }
        }
    }

    /**
     * @inheritDoc
     *
     * @throws ReflectionException
     */
    public function classPropertyHasDefaultValue(string $fqcn, string $propertyName): bool
    {
        $reflectionClass = new ReflectionClass($fqcn);
        $property = $reflectionClass->getProperty($propertyName);

        return $property->hasDefaultValue();
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function promotedPropertyHasDefaultValue(string $fqcn, string $propertyName): bool
    {
        $reflectionClass = new ReflectionClass($fqcn);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor !== null) {
            foreach ($constructor->getParameters() as $parameter) {
                if ($parameter->getName() === $propertyName &&
                    $parameter->isPromoted()
                ) {
                    return $parameter->isDefaultValueAvailable();
                }
            }
        }

        throw new Exception('Property "' . $propertyName . '" is either not promoted or does not exist.');
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function getPropertyDefaultValue(string $fqcn, string $propertyName): mixed
    {
        try {
            return $this->getPromotedPropertyDefaultValue($fqcn, $propertyName);
        } catch (Throwable) {
            try {
                return $this->getClassPropertyDefaultValue($fqcn, $propertyName);
            } catch (Throwable) {
                throw new Exception('Property "' . $propertyName . '" does not exist or does not have a default value.');
            }
        }
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function getClassPropertyDefaultValue(string $fqcn, string $propertyName): mixed
    {
        $reflectionClass = new ReflectionClass($fqcn);

        if ($reflectionClass->hasProperty($propertyName)) {
            $property = $reflectionClass->getProperty($propertyName);

            if (!$property->isPromoted()) {
                return $property->getDefaultValue();
            }
        }

        throw new Exception('Property "' . $propertyName . '" either does not exist or has no default value.');
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function getPromotedPropertyDefaultValue(string $fqcn, string $propertyName): mixed
    {
        $reflectionClass = new ReflectionClass($fqcn);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor !== null) {
            foreach ($constructor->getParameters() as $parameter) {
                if ($parameter->getName() === $propertyName &&
                    $parameter->isPromoted() &&
                    $parameter->isDefaultValueAvailable()
                ) {
                    return $parameter->getDefaultValue();
                }
            }
        }

        throw new Exception('Property "' . $propertyName . '" is either not promoted, does not exist, or has no default value.');
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function isPropertyNullable(string $fqcn, string $propertyName): bool
    {
        try {
            return $this->isPromotedPropertyNullable($fqcn, $propertyName);
        } catch (Throwable) {
            try {
                return $this->isClassPropertyNullable($fqcn, $propertyName);
            } catch (Throwable) {
                throw new Exception('Property "' . $propertyName . '" does not exist.');
            }
        }
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function isClassPropertyNullable(string $fqcn, string $propertyName): bool
    {
        $reflectionClass = new ReflectionClass($fqcn);

        if ($reflectionClass->hasProperty($propertyName)) {
            $property = $reflectionClass->getProperty($propertyName);

            if (!$property->isPromoted()) {
                return $property->getType()?->allowsNull();
            }
        }

        throw new Exception('Property "' . $propertyName . '" does not exist or is promoted.');
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function isPromotedPropertyNullable(string $fqcn, string $propertyName): bool
    {
        $reflectionClass = new ReflectionClass($fqcn);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor !== null) {
            foreach ($constructor->getParameters() as $parameter) {
                if ($parameter->getName() === $propertyName &&
                    $parameter->isPromoted()
                ) {
                    return $parameter->getType()?->allowsNull();
                }
            }
        }

        throw new Exception('Property "' . $propertyName . '" is either not promoted or does not exist.');
    }
}
