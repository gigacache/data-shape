<?php

declare(strict_types=1);

namespace DataShape\Interfaces;

interface CollectionInterface
{
    public static function create(): static;

    public static function build(object $prototype, array $json): static;

    public function add(object $item): void;

    public function remove(object $item): void;

    public function getFirst(): ?object;

    public function getLast(): ?object;

    public function clear(): void;

    public function get(): array;
}
