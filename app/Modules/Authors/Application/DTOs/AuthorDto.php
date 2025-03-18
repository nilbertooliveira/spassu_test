<?php

namespace App\Modules\Authors\Application\DTOs;

use App\Modules\Authors\Domain\Entities\AuthorEntity;

class AuthorDto
{

    private ?int $id;
    private string $name;

    public function __construct(string $name, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @param AuthorEntity[] $data
     * @return array
     */
    public static function fromEntities(array $data): array
    {
        return collect($data)->map(function (AuthorEntity $item) {
            return new self(
                $item->getName(),
                $item->getId(),
            );
        })->toArray();
    }

    public static function toArray(array $data): array
    {
        return collect($data)->map(function ($item) {
            return [
                'id' => $item->getId(),
                'name' => $item->getName(),
            ];
        })->toArray();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
