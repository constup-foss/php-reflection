<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection;

interface ReflectionServiceInterface
{
    /**
     * Uses propertyHasDefaultValue() and classPropertyHasDefaultValue() to determine if a property has a default value.
     * Throws an exception if the property does not exist.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return bool
     */
    public function propertyHasDefaultValue(
        string $fqcn,
        string $propertyName
    ): bool;

    /**
     * Tries to determine if a classic, non-promoted class property has a default value.
     * Throws an exception if the property does not exist.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return bool
     */
    public function classPropertyHasDefaultValue(
        string $fqcn,
        string $propertyName
    ): bool;

    /**
     * Tries to determine if a promoted property has a default value.
     * Throws an exception if the property does not exist.
     * Throws an exception if the property is not promoted.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return bool
     */
    public function promotedPropertyHasDefaultValue(
        string $fqcn,
        string $propertyName
    ): bool;

    /**
     * Combines getPromotedPropertyDefaultValue() and getClassPropertyDefaultValue() to get a default value of a
     * property.
     * Throws an exception if there is no default value or the property does not exist.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return mixed
     */
    public function getPropertyDefaultValue(
        string $fqcn,
        string $propertyName
    ): mixed;

    /**
     * Tries to get a default value of a classic, non-promoted class property.
     * Throws an exception if there is no default value or the property does not exist.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return mixed
     */
    public function getClassPropertyDefaultValue(
        string $fqcn,
        string $propertyName
    ): mixed;

    /**
     * Tries to get a default value of a promoted property.
     * Throws an exception if there is no default value, the property is not promoted, or the property does not exist.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return mixed
     */
    public function getPromotedPropertyDefaultValue(
        string $fqcn,
        string $propertyName
    ): mixed;

    /**
     * Uses isPromotedPropertyNullable() and isClassPropertyNullable() to determine if a property is nullable.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return bool
     */
    public function isPropertyNullable(
        string $fqcn,
        string $propertyName
    ): bool;

    /**
     * Tries to determine if a promoted property is nullable.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return bool
     */
    public function isPromotedPropertyNullable(
        string $fqcn,
        string $propertyName
    ): bool;

    /**
     * Tries to determine if a classic, non-promoted class property is nullable.
     *
     * @param string $fqcn
     * @param string $propertyName
     *
     * @return bool
     */
    public function isClassPropertyNullable(
        string $fqcn,
        string $propertyName
    ): bool;
}
