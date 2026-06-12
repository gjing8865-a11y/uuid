<?php

declare(strict_types=1);

namespace Ramsey\Uuid\Test\Lazy;

use Ramsey\Uuid\Lazy\LazyUuidFromString;
use Ramsey\Uuid\Test\TestCase;
use Ramsey\Uuid\Uuid;

class LazyUuidFromStringTest extends TestCase
{
    public function testToUuidV6FromV1(): void
    {
        $v1String = 'f81d4fae-7dec-11d0-a765-00a0c91e6bf6';
        $lazyUuid = Uuid::fromString($v1String);

        $this->assertInstanceOf(LazyUuidFromString::class, $lazyUuid);

        $v6 = $lazyUuid->toUuidV6();

        $this->assertSame('1d07decf-81d4-6fae-a765-00a0c91e6bf6', $v6->toString());

        // Also test going back to v1
        $v1 = $v6->toUuidV1();
        $this->assertSame($v1String, $v1->toString());
    }

    public function testToUuidV6FromV6(): void
    {
        $v6String = '1d07decf-81d4-6fae-a765-00a0c91e6bf6';
        $lazyUuid = Uuid::fromString($v6String);

        $this->assertInstanceOf(LazyUuidFromString::class, $lazyUuid);

        $v6 = $lazyUuid->toUuidV6();

        $this->assertSame($v6String, $v6->toString());
    }
}
