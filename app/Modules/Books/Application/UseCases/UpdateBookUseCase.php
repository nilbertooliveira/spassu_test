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
        $bookEntity = BookEntity::fromDto($bookDto);

        $data = $this->bookRepository->update($bookEntity, $bookDto->getId());

        return BookDto::fromEntity($data);
    }
}
