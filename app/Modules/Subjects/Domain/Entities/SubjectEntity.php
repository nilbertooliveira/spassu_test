<?php

namespace App\Modules\Subjects\Domain\Entities;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class SubjectEntity
{

    private ?int $id;
    private string $description;
    private Carbon $createdAt;
    private Carbon $updatedAt;

    public function __construct(
        string $description,
        Carbon $createdAt,
        Carbon $updatedAt,
        ?int $id = null
    )
    {
        $this->id = $id;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param Collection $data
     * @return SubjectEntity[]
     */
    public static function fromCollection(Collection $data): array
    {
        return $data->map(function ($item) {
            return new self(
                $item->Descricao,
                new Carbon($item->created_at),
                new Carbon($item->updated_at),
                $item->codAs,
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
    public function getDescription(): string
    {
        return $this->description;
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
