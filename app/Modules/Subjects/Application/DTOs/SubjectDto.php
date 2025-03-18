<?php

namespace App\Modules\Subjects\Application\DTOs;

use App\Modules\Subjects\Domain\Entities\SubjectEntity;

class SubjectDto
{

    private ?int $id;
    private string $description;

    public function __construct(string $description, ?int $id = null)
    {
        $this->id = $id;
        $this->description = $description;
    }

    /**
     * @param SubjectEntity[] $data
     * @return array
     */
    public static function fromEntities(array $data): array
    {
        return collect($data)->map(function (SubjectEntity $item) {
            return new self(
                $item->getDescription(),
                $item->getId(),
            );
        })->toArray();
    }

    public static function toArray(array $data): array
    {
        return collect($data)->map(function ($item) {
            return [
                'id' => $item->getId(),
                'description' => $item->getDescription(),
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
    public function getDescription(): string
    {
        return $this->description;
    }
}
