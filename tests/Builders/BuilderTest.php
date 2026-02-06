<?php

declare(strict_types=1);

namespace DataShape\Tests\Builders;

use DataShape\Builders\Builder;
use PHPUnit\Framework\TestCase;

final class BuilderTest extends TestCase
{
    public function testData(): void
    {
        $builder = new Builder();

        $input = [
            'id' => '42',
            'email' => 'test@example.com',
        ];

        $result = $builder->map($input);

        $this->assertSame(42, $result['id']);
        $this->assertSame('test@example.com', $result['email']);
    }
}
