<?php

namespace App\Modules\Reports\Domain\Entities;

use App\Modules\Reports\Infrastructure\Models\VwBooksReport;
use Illuminate\Support\Collection;

class ReportEntity
{

    private string $author;
    private string $title;
    private string $publisher;
    private string $yearPublication;
    private int $edition;
    private float $price;
    private string $subjects;

    public function __construct(
        string $author,
        string $title,
        string $publisher,
        string $yearPublication,
        int    $edition,
        float  $price,
        string $subjects
    )
    {
        $this->author = $author;
        $this->title = $title;
        $this->publisher = $publisher;
        $this->yearPublication = $yearPublication;
        $this->edition = $edition;
        $this->price = $price;
        $this->subjects = $subjects;
    }

    /**
     * @param Collection $data
     * @return ReportEntity[]
     */
    public static function fromCollection(Collection $data): array
    {
        return collect($data)->map(function (VwBooksReport $item) {
            return new self(
                author: $item->autores,
                title: $item->titulo,
                publisher: $item->editora,
                yearPublication: $item->ano_publicacao,
                edition: $item->edicao,
                price: $item->valor,
                subjects: $item->assuntos
            );
        })->toArray();
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function getYearPublication(): string
    {
        return $this->yearPublication;
    }

    public function getEdition(): int
    {
        return $this->edition;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSubjects(): string
    {
        return $this->subjects;
    }

}
