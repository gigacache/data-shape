<?php

declare(strict_types=1);

namespace DataShape\Builders;

use DataShape\Interfaces\BuilderInterface;

class Builder implements BuilderInterface
{
    protected string|null $id;
    protected string|null $uid;
    protected string|null $objectId;
    protected string|null $created;
    protected string|null $updated;

    public static function create(): static
    {
        return new static();
    }

    public function createFromJson(array $json): static
    {
        $builder = static::create();

        $builder
            ->withId($json['id'] ?? null)
            ->withUid($json['uid'] ?? null)
            ->withObjectId($json['objectId'] ?? null)
            ->withCreated($json['created'] ?? null)
            ->withUpdated($json['updated'] ?? null);

        return $builder;
    }

    public function toJson(): array
    {
        return [
            'id' => $this->getId(),
            'uid' => $this->getUid(),
            'objectId' => $this->getObjectId(),
            'created' => $this->getCreated(),
            'updated' => $this->getUpdated(),
        ];
    }

    public function withId(?string $id): Builder
    {
        $this->id = $id;
        return $this;
    }

    public function withUid(?string $uid): Builder
    {
        $this->uid = $uid;
        return $this;
    }

    public function withObjectId(?string $objectId): Builder
    {
        $this->objectId = $objectId;
        return $this;
    }

    public function withCreated(?string $created): Builder
    {
        $this->created = $created;
        return $this;
    }

    public function withUpdated(?string $updated): Builder
    {
        $this->updated = $updated;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function getObjectId(): ?string
    {
        return $this->objectId;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function getUpdated(): ?string
    {
        return $this->updated;
    }
}
