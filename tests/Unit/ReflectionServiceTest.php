<?php

declare(strict_types = 1);

namespace ConstupFoss\PhpReflection\Tests\Unit;

use ConstupFoss\PhpReflection\ReflectionService;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\ClassPropertyHasDefaultValueDataProvider;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\GetClassPropertyDefaultValueDataProvider;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\GetPromotedPropertyDefaultValueDataProvider;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\GetPropertyDefaultValueDataProvider;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\IsClassPropertyNullableDataProvider;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\IsPromotedPropertyNullableDataProvider;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\IsPropertyNullableDataProvider;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\PromotedPropertyHasDefaultValueDataProvider;
use ConstupFoss\PhpReflection\Tests\Unit\DataProvider\ReflectionService\PropertyHasDefaultValueDataProvider;
use Exception;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class ReflectionServiceTest extends TestCase
{
    #[DataProviderExternal(
        PropertyHasDefaultValueDataProvider::class,
        'provide_PromotedProperty_HappyFlow'
    )]
    public function test_propertyHasDefaultValue_PromotedProperty_HappyFlow(
        string $fqcn,
        string $propertyName,
        bool $expected
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'promotedPropertyHasDefaultValue',
                'classPropertyHasDefaultValue',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('promotedPropertyHasDefaultValue')
            ->with($fqcn, $propertyName)
            ->willReturn($expected);
        $class->expects($this->never())
            ->method('classPropertyHasDefaultValue');

        $result = $class->propertyHasDefaultValue($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        PropertyHasDefaultValueDataProvider::class,
        'provide_ClassProperty_HappyFlow'
    )]
    public function test_propertyHasDefaultValue_ClassProperty_HappyFlow(
        string $fqcn,
        string $propertyName,
        bool $expected
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'promotedPropertyHasDefaultValue',
                'classPropertyHasDefaultValue',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('promotedPropertyHasDefaultValue')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());
        $class->expects($this->once())
            ->method('classPropertyHasDefaultValue')
            ->with($fqcn, $propertyName)
            ->willReturn($expected);

        $result = $class->propertyHasDefaultValue($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        PropertyHasDefaultValueDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_propertyHasDefaultValue_ErrorFlow(
        string $fqcn,
        string $propertyName,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'promotedPropertyHasDefaultValue',
                'classPropertyHasDefaultValue',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('promotedPropertyHasDefaultValue')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());
        $class->expects($this->once())
            ->method('classPropertyHasDefaultValue')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());

        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $result = $class->propertyHasDefaultValue($fqcn, $propertyName);
    }

    #[DataProviderExternal(
        ClassPropertyHasDefaultValueDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_classPropertyHasDefaultValue_HappyFlow(
        string $fqcn,
        string $propertyName,
        bool $expected
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();

        $result = $class->propertyHasDefaultValue($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        PromotedPropertyHasDefaultValueDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_promotedPropertyHasDefaultValue_HappyFlow(
        string $fqcn,
        string $propertyName,
        bool $expected
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();

        $result = $class->propertyHasDefaultValue($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        GetPropertyDefaultValueDataProvider::class,
        'provide_PromotedPropertyHasDefault_HappyFlow'
    )]
    public function test_getPropertyDefaultValue_PromotedPropertyHasDefault_HappyFlow(
        string $fqcn,
        string $propertyName,
        mixed $expected
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'getPromotedPropertyDefaultValue',
                'getClassPropertyDefaultValue',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('getPromotedPropertyDefaultValue')
            ->with($fqcn, $propertyName)
            ->willReturn($expected);
        $class->expects($this->never())
            ->method('getClassPropertyDefaultValue');


        $result = $class->getPropertyDefaultValue($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        GetPropertyDefaultValueDataProvider::class,
        'provide_ClassPropertyHasDefault_HappyFlow'
    )]
    public function test_getPropertyDefaultValue_ClassPropertyHasDefault_HappyFlow(
        string $fqcn,
        string $propertyName,
        mixed $expected
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'getPromotedPropertyDefaultValue',
                'getClassPropertyDefaultValue',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('getPromotedPropertyDefaultValue')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());
        $class->expects($this->once())
            ->method('getClassPropertyDefaultValue')
            ->with($fqcn, $propertyName)
            ->willReturn($expected);

        $result = $class->getPropertyDefaultValue($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        GetPropertyDefaultValueDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_getPropertyDefaultValue_ErrorFlow(
        string $fqcn,
        string $propertyName,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'getPromotedPropertyDefaultValue',
                'getClassPropertyDefaultValue',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('getPromotedPropertyDefaultValue')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());
        $class->expects($this->once())
            ->method('getClassPropertyDefaultValue')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());

        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $class->getPropertyDefaultValue($fqcn, $propertyName);
    }

    #[DataProviderExternal(
        GetClassPropertyDefaultValueDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_getClassPropertyDefaultValue_HappyFlow(
        string $fqcn,
        string $propertyName,
        mixed $expected
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();

        $result = $class->getClassPropertyDefaultValue($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        GetClassPropertyDefaultValueDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_getClassPropertyDefaultValue_ErrorFlow(
        string $fqcn,
        string $propertyName,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'getPromotedPropertyDefaultValue',
            ])
            ->getStub();

        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $result = $class->getClassPropertyDefaultValue($fqcn, $propertyName);
    }

    #[DataProviderExternal(
        GetPromotedPropertyDefaultValueDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_getPromotedPropertyDefaultValue_HappyFlow(
        string $fqcn,
        string $propertyName,
        mixed $expected
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();

        $result = $class->getPromotedPropertyDefaultValue($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        GetPromotedPropertyDefaultValueDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_getPromotedPropertyDefaultValue_ErrorFlow(
        string $fqcn,
        string $propertyName,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();
        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $class->getPromotedPropertyDefaultValue($fqcn, $propertyName);
    }

    #[DataProviderExternal(
        IsPropertyNullableDataProvider::class,
        'provide_PromotedProperty_HappyFlow'
    )]
    public function test_isPropertyNullable_PromotedProperty_HappyFlow(
        string $fqcn,
        string $propertyName,
        bool $expected
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'isPromotedPropertyNullable',
                'isClassPropertyNullable',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('isPromotedPropertyNullable')
            ->with($fqcn, $propertyName)
            ->willReturn($expected);
        $class->expects($this->never())
            ->method('isClassPropertyNullable');

        $result = $class->isPropertyNullable($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        IsPropertyNullableDataProvider::class,
        'provide_ClassProperty_HappyFlow'
    )]
    public function test_isPropertyNullable_ClassProperty_HappyFlow(
        string $fqcn,
        string $propertyName,
        bool $expected
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'isPromotedPropertyNullable',
                'isClassPropertyNullable',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('isPromotedPropertyNullable')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());
        $class->expects($this->once())
            ->method('isClassPropertyNullable')
            ->with($fqcn, $propertyName)
            ->willReturn($expected);

        $result = $class->isPropertyNullable($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        IsPropertyNullableDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_isPropertyNullable_ErrorFlow(
        string $fqcn,
        string $propertyName,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        $class = $this->getMockBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'isPromotedPropertyNullable',
                'isClassPropertyNullable',
            ])
            ->getMock();
        $class->expects($this->once())
            ->method('isPromotedPropertyNullable')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());
        $class->expects($this->once())
            ->method('isClassPropertyNullable')
            ->with($fqcn, $propertyName)
            ->willThrowException(new Exception());

        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $result = $class->isPropertyNullable($fqcn, $propertyName);
    }

    #[DataProviderExternal(
        IsClassPropertyNullableDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_isClassPropertyNullable_HappyFlow(
        string $fqcn,
        string $propertyName,
        bool $expected
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();

        $result = $class->isClassPropertyNullable($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        IsClassPropertyNullableDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_isClassPropertyNullable_ErrorFlow(
        string $fqcn,
        string $propertyName,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();

        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $result = $class->isClassPropertyNullable($fqcn, $propertyName);
    }

    #[DataProviderExternal(
        IsPromotedPropertyNullableDataProvider::class,
        'provide_HappyFlow'
    )]
    public function test_isPromotedPropertyNullable_HappyFlow(
        string $fqcn,
        string $propertyName,
        bool $expected
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();

        $result = $class->isPromotedPropertyNullable($fqcn, $propertyName);
        $this->assertEquals($expected, $result);
    }

    #[DataProviderExternal(
        IsPromotedPropertyNullableDataProvider::class,
        'provide_ErrorFlow'
    )]
    public function test_isPromotedPropertyNullable_ErrorFlow(
        string $fqcn,
        string $propertyName,
        string $expectedException,
        string $expectedExceptionMessage
    ): void {
        /** @var ReflectionService $class */
        $class = $this->getStubBuilder(ReflectionService::class)
            ->disableOriginalConstructor()
            ->onlyMethods([])
            ->getStub();

        $this->expectException($expectedException);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $result = $class->isPromotedPropertyNullable($fqcn, $propertyName);
    }
}
