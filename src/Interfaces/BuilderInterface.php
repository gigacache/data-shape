<?php

declare(strict_types=1);

namespace DataShape\Interfaces;

interface BuilderInterface
{
    public static function create(): static;

    public function createFromJson(array $data): static;

    public function toJson(): array;
}
