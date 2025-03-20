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

    public static function fromArray(array $data): BookDto
    {
        return new BookDto(
            title: $data['title'],
            publisher: $data['publisher'],
            edition: $data['edition'],
            yearPublication: $data['yearPublication'],
            price: $data['price'],
            authors: $data['authors'],
            subjects: $data['subjects'],
            id: $data['id'] ?? null,
        );
    }

    /**
     * @param BookEntity[] $entities
     * @return BookDto[]
     */
    public static function fromEntities(array $entities): array
    {
        return array_map(function (BookEntity $item) {
            return self::fromEntity($item);
        }, $entities);
    }

    public static function fromEntity(BookEntity $entity): BookDto
    {
        return new self(
            $entity->getTitle(),
            $entity->getPublisher(),
            $entity->getEdition(),
            $entity->getYearPublication(),
            $entity->getPrice(),
            $entity->getAuthors(),
            $entity->getSubjects(),
            $entity->getId(),
        );
    }

    /**
     * @param BookDto|BookDto[] $books
     * @return array
     */
    public static function toArray(BookDto|array $books): array
    {
        if ($books instanceof BookDto) {
            return $books->toSingleArray();
        }
        return array_map(function ($book) {
            if (!$book instanceof BookDto) {
                throw new \InvalidArgumentException('Todos os itens devem ser instâncias de BookDto.');
            }
            return $book->toSingleArray();
        }, $books);
    }


    private function toSingleArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'publisher' => $this->getPublisher(),
            'edition' => $this->getEdition(),
            'yearPublication' => $this->getYearPublication(),
            'price' => $this->getPrice(),
            'authors' => AuthorDto::toArray($this->getAuthors()),
            'subjects' => SubjectDto::toArray($this->getSubjects()),
        ];
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
