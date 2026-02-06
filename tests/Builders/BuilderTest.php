<?php

declare(strict_types=1);

namespace DataShape\Tests\Builders;

use PHPUnit\Framework\TestCase;
use DataShape\Builders\Builder;

final class BuilderTest extends TestCase
{
    public function testFluentSettersAndGetters(): void
    {
        $builder = Builder::create()
            ->withId('123')
            ->withUid('uid-456')
            ->withObjectId('obj-789')
            ->withCreated('2026-02-06T12:00:00Z')
            ->withUpdated('2026-02-06T12:30:00Z');

        $this->assertSame('123', $builder->getId());
        $this->assertSame('uid-456', $builder->getUid());
        $this->assertSame('obj-789', $builder->getObjectId());
        $this->assertSame('2026-02-06T12:00:00Z', $builder->getCreated());
        $this->assertSame('2026-02-06T12:30:00Z', $builder->getUpdated());
    }

    public function testToJson(): void
    {
        $builder = Builder::create()
            ->withId('123')
            ->withUid('uid-456')
            ->withObjectId('obj-789')
            ->withCreated('2026-02-06T12:00:00Z')
            ->withUpdated('2026-02-06T12:30:00Z');

        $expected = [
            'id' => '123',
            'uid' => 'uid-456',
            'objectId' => 'obj-789',
            'created' => '2026-02-06T12:00:00Z',
            'updated' => '2026-02-06T12:30:00Z',
        ];

        $this->assertSame($expected, $builder->toJson());
    }

    public function testCreateFromJson(): void
    {
        $json = [
            'id' => '123',
            'uid' => 'uid-456',
            'objectId' => 'obj-789',
            'created' => '2026-02-06T12:00:00Z',
            'updated' => '2026-02-06T12:30:00Z',
        ];

        $builder = Builder::create()->createFromJson($json);

        $this->assertSame('123', $builder->getId());
        $this->assertSame('uid-456', $builder->getUid());
        $this->assertSame('obj-789', $builder->getObjectId());
        $this->assertSame('2026-02-06T12:00:00Z', $builder->getCreated());
        $this->assertSame('2026-02-06T12:30:00Z', $builder->getUpdated());
    }

    public function testCreateFromJsonWithMissingKeys(): void
    {
        $json = [
            'id' => '123',
            'uid' => 'uid-456'
        ];

        $builder = Builder::create()->createFromJson($json);

        $this->assertSame('123', $builder->getId());
        $this->assertSame('uid-456', $builder->getUid());
        $this->assertNull($builder->getObjectId());
        $this->assertNull($builder->getCreated());
        $this->assertNull($builder->getUpdated());
    }
}
