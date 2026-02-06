<?php

declare(strict_types=1);

namespace DataShape\Interfaces;

use DataShape\Builders\Builder;

interface BuilderInterface
{
    /**
     * Create a new instance of the Builder.
     *
     * @return static
     */
    public static function create(): static;

    /**
     * Create a Builder instance from an associative array (decoded JSON).
     *
     * @param array<mixed> $data
     * @return static
     */
    public function createFromJson(array $data): static;

    /**
     * Convert the Builder instance to an associative array suitable for JSON.
     *
     * @return array
     */
    public function toJson(): array;
}
