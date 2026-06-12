<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Test\Lazy;

use Ramsey\Uuid\Lazy\LazyUuidFromString;
use Ramsey\Uuid\Rfc4122\UuidV1;
use Ramsey\Uuid\Rfc4122\UuidV6;
use Ramsey\Uuid\Test\TestCase;
use Ramsey\Uuid\Uuid;

class LazyUuidFromStringTest extends TestCase
{
    public function testLazyV1ToUuidV6(): void
    {
        /** @var LazyUuidFromString $v1 */
        $v1 = Uuid::fromString('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');

        $v6 = $v1->toUuidV6();

        $this->assertInstanceOf(UuidV6::class, $v6);
        $this->assertSame(6, $v6->getVersion());
        $this->assertSame('1d07decf-81d4-6fae-a765-00a0c91e6bf6', $v6->toString());
    }

    public function testLazyV1ToUuidV6RoundTripsToOriginalV1(): void
    {
        /** @var LazyUuidFromString $v1 */
        $v1 = Uuid::fromString('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');

        $v6 = $v1->toUuidV6();
        $back = $v6->toUuidV1();

        $this->assertInstanceOf(UuidV1::class, $back);
        $this->assertSame('f81d4fae-7dec-11d0-a765-00a0c91e6bf6', $back->toString());
    }

    public function testLazyV6ToUuidV6ReturnsInstanceUnchanged(): void
    {
        /** @var LazyUuidFromString $v6 */
        $v6 = Uuid::fromString('1d07decf-81d4-6fae-a765-00a0c91e6bf6');

        $result = $v6->toUuidV6();

        $this->assertInstanceOf(UuidV6::class, $result);
        $this->assertSame(6, $result->getVersion());
        $this->assertSame('1d07decf-81d4-6fae-a765-00a0c91e6bf6', $result->toString());
    }
}
