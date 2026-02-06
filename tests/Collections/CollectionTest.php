<?php

declare(strict_types=1);

namespace DataShape\Tests\Collections;

use PHPUnit\Framework\TestCase;
use DataShape\Collections\Collection;
use DataShape\Builders\Builder;

final class CollectionTest extends TestCase
{
    public function testCreateReturnsEmptyCollection(): void
    {
        $collection = Collection::create();
        $this->assertEmpty($collection->get());
    }

    public function testAddAndGet(): void
    {
        $collection = Collection::create();
        $builder1 = Builder::create()->withId('1');
        $builder2 = Builder::create()->withId('2');

        $collection->add($builder1);
        $collection->add($builder2);

        $items = $collection->get();

        $this->assertCount(2, $items);
        $this->assertSame($builder1, $items[0]);
        $this->assertSame($builder2, $items[1]);
    }

    public function testRemove(): void
    {
        $collection = Collection::create();
        $builder1 = Builder::create()->withId('1');
        $builder2 = Builder::create()->withId('2');

        $collection->add($builder1);
        $collection->add($builder2);

        $collection->remove($builder1);
        $items = $collection->get();

        $this->assertCount(1, $items);
        $this->assertSame($builder2, $items[0]);

        // Removing an item not in collection does nothing
        $collection->remove($builder1);
        $this->assertCount(1, $collection->get());
    }

    public function testGetFirstAndGetLast(): void
    {
        $collection = Collection::create();
        $builder1 = Builder::create()->withId('1');
        $builder2 = Builder::create()->withId('2');

        $this->assertNull($collection->getFirst());
        $this->assertNull($collection->getLast());

        $collection->add($builder1);
        $collection->add($builder2);

        $this->assertSame($builder1, $collection->getFirst());
        $this->assertSame($builder2, $collection->getLast());
    }

    public function testClear(): void
    {
        $collection = Collection::create();
        $builder = Builder::create()->withId('1');
        $collection->add($builder);

        $this->assertNotEmpty($collection->get());

        $collection->clear();
        $this->assertEmpty($collection->get());
    }

    public function testBuildFromJson(): void
    {
        $jsonData = [
            ['id' => '1', 'uid' => 'uid1'],
            ['id' => '2', 'uid' => 'uid2'],
        ];

        $collection = Collection::build(new Builder(), $jsonData);

        $items = $collection->get();

        $this->assertCount(2, $items);
        $this->assertSame('1', $items[0]->getId());
        $this->assertSame('uid1', $items[0]->getUid());
        $this->assertSame('2', $items[1]->getId());
        $this->assertSame('uid2', $items[1]->getUid());
    }

    public function testBuildReturnsCorrectClassWhenExtended(): void
    {
        $jsonData = [
            ['id' => '1'],
        ];

        // Subclass of Builder
        $subBuilder = new class extends Builder {
        };

        $collection = Collection::build($subBuilder, $jsonData);
        $items = $collection->get();

        $this->assertInstanceOf(get_class($subBuilder), $items[0]);
    }
}
