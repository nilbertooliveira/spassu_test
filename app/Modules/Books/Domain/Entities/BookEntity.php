<?php

namespace App\Modules\Books\Domain\Entities;

use App\Modules\Authors\Domain\Entities\AuthorEntity;
use App\Modules\Subjects\Domain\Entities\SubjectEntity;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BookEntity
{
    private ?int $id;
    private string $title;
    private string $publisher;
    private int $edition;
    private string $yearPublication;
    private float $price;
    private Carbon $createdAt;
    private Carbon $updatedAt;
    /**
     * @var AuthorEntity[] $authors
     */
    private array $authors;
    /**
     * @var SubjectEntity[]
     */
    private array $subjects;

    public function __construct(
        string $title,
        string $publisher,
        int    $edition,
        string $yearPublication,
        float  $price,
        array  $authors,
        array  $subjects,
        Carbon $createdAt,
        Carbon $updatedAt,
        ?int   $id = null,
    )
    {

        $this->id = $id;
        $this->title = $title;
        $this->publisher = $publisher;
        $this->edition = $edition;
        $this->yearPublication = $yearPublication;
        $this->price = $price;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->authors = $authors;
        $this->subjects = $subjects;
    }

    /**
     * @param Collection $data
     * @return BookEntity[]
     */
    public static function fromCollection(Collection $data): array
    {
        return $data->map(function ($item) {
            return new self(
                $item->Titulo,
                $item->Editora,
                $item->Edicao,
                $item->AnoPublicacao,
                $item->Valor,
                AuthorEntity::fromCollection($item->authors),
                SubjectEntity::fromCollection($item->subjects),
                new Carbon($item->created_at),
                new Carbon($item->updated_at),
                $item->Codl,
            );
        })->toArray();
    }

    public static function toArray(array $data): array
    {
        return collect($data)->map(function ($item) {
            return [
                'id' => $item->getId(),
                'title' => $item->getTitle(),
                'publisher' => $item->getPublisher(),
                'edition' => $item->getEdition(),
                'yearPublication' => $item->getYearPublication(),
                'price' => "R$" . number_format($item->getPrice()),
                'authors' => AuthorEntity::fromCollection($item->authors),
                'subjects' => SubjectEntity::fromCollection($item->subjects),
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
    }

    /**
     * @return int
     */
    public function getEdition(): int
    {
        return $this->edition;
    }

    /**
     * @return string
     */
    public function getYearPublication(): string
    {
        return $this->yearPublication;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
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

    /**
     * @return AuthorEntity[]
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @return SubjectEntity[]
     */
    public function getSubjects(): array
    {
        return $this->subjects;
    }
}
