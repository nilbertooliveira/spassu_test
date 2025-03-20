<?php

namespace App\Modules\Books\Application\UseCases;

use App\Modules\Books\Application\DTOs\BookDto;
use App\Modules\Books\Domain\Entities\BookEntity;
use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;

class GetBookUseCase
{

    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param int $id
     * @return BookDto
     */
    public function execute(int $id): BookDto
    {
        $data = $this->bookRepository->find($id);

        return BookDto::fromEntity($data);
    }
}
