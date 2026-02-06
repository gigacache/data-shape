<?php

declare(strict_types=1);

namespace DataShape\Collections;

use DataShape\Interfaces\CollectionInterface;

class Collection implements CollectionInterface
{
    protected array $items = [];


    public static function create(): static
    {
        return new static();
    }

    public static function build(object $prototype, array $json): static
    {
        $collection = static::create();
        foreach ($json as $item) {
            $collection->add($prototype->createFromJson($item));
        }

        return $collection;
    }

    public function add(object $item): void
    {
        $this->items[] = $item;
    }

    public function remove(object $item): void
    {
        $this->items = array_filter(
            $this->items,
            fn($i) => $i !== $item
        );
        // reindex array
        $this->items = array_values($this->items);
    }

    public function getFirst(): ?object
    {
        return $this->items[0] ?? null;
    }

    public function getLast(): ?object
    {
        return end($this->items) ?: null;
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function get(): array
    {
        return $this->items;
    }
}
