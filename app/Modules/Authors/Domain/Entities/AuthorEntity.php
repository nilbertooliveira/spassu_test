<?php

namespace App\Modules\Authors\Domain\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class AuthorEntity
{

    private ?int $id;
    private string $name;
    private Carbon $createdAt;
    private Carbon $updatedAt;

    public function __construct(
        string $name,
        Carbon $createdAt,
        Carbon $updatedAt,
        ?int $id = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param Collection $data
     * @return AuthorEntity[]
     */
    public static function fromCollection(Collection $data): array
    {
        return $data->map(function ($item) {
            return new self(
                $item->Nome,
                new Carbon($item->created_at),
                new Carbon($item->updated_at),
                $item->CodAu,
            );
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

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

}
