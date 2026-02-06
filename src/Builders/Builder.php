<?php

declare(strict_types=1);

namespace DataShape\Builders;

class Builder
{
    public function map(array $data): array
    {
        return [
            'id' => (int) $data['id'],
            'email' => (string) $data['email'],
        ];
    }
}
