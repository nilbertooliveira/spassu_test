<?php

namespace App\Modules\Books\Application\UseCases;

use App\Modules\Books\Application\DTOs\BookDto;
use App\Modules\Books\Domain\Entities\BookEntity;
use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;

class UpdateBookUseCase
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute(BookDto $bookDto): BookDto
    {
        $bookEntity = new BookEntity(
            title: $bookDto->getTitle(),
            publisher: $bookDto->getPublisher(),
            edition: $bookDto->getEdition(),
            yearPublication: $bookDto->getYearPublication(),
            price: $bookDto->getPrice(),
            authors: $bookDto->getAuthors(),
            subjects: $bookDto->getSubjects(),
            createdAt: now(),
            updatedAt: now(),
            id: $bookDto->getId(),
        );

        $data = $this->bookRepository->update($bookEntity, $bookDto->getId());

        return new BookDto(title: $data->getTitle(),
            publisher: $data->getPublisher(),
            edition: $data->getEdition(),
            yearPublication: $data->getYearPublication(),
            price: $data->getPrice(),
            authors: $data->getAuthors(),
            subjects: $data->getSubjects(),
            id: $data->getId()
        );
    }
}
