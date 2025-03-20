<?php

namespace App\Modules\Books\Application\UseCases;

use App\Modules\Books\Application\DTOs\BookDto;
use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ListBooksUseCase
{

    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return BookDto[]
     */
    public function execute(): array
    {
        $data = $this->bookRepository->all();

        return BookDto::fromEntities($data);
    }
}
