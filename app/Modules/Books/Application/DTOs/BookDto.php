<?php

namespace App\Modules\Books\Application\DTOs;

use App\Modules\Authors\Application\DTOs\AuthorDto;
use App\Modules\Books\Domain\Entities\BookEntity;
use App\Modules\Subjects\Application\DTOs\SubjectDto;

class BookDto
{


    private string $title;
    private string $publisher;
    private int $edition;
    private string $yearPublication;
    private float $price;
    private array $authors;
    private array $subjects;

    private ?int $id;

    public function __construct(
        string $title,
        string $publisher,
        int    $edition,
        string $yearPublication,
        float  $price,
        array  $authors,
        array  $subjects,
        ?int   $id = null,
    )
    {
        $this->title = $title;
        $this->publisher = $publisher;
        $this->edition = $edition;
        $this->yearPublication = $yearPublication;
        $this->price = $price;
        $this->subjects = $subjects;
        $this->authors = $authors;
        $this->id = $id;
    }

    /**
     * @param BookEntity[] $data
     * @return array
     */
    public static function fromEntities(array $data): array
    {
        return collect($data)->map(function (BookEntity $item) {
            return new self(
                $item->getTitle(),
                $item->getPublisher(),
                $item->getEdition(),
                $item->getYearPublication(),
                $item->getPrice(),
                $item->getAuthors(),
                $item->getSubjects(),
                $item->getId()
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
                'price' => $item->getPrice(),
                'authors' => AuthorDto::toArray($item->getAuthors()),
                'subjects' => SubjectDto::toArray($item->getSubjects()),
            ];
        })->toArray();
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
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @return array
     */
    public function getSubjects(): array
    {
        return $this->subjects;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
