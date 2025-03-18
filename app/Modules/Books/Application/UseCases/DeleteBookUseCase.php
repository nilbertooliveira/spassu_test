<?php

namespace App\Modules\Books\Application\UseCases;

use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;

class DeleteBookUseCase
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function execute(int $id): bool
    {
        return $this->bookRepository->delete($id);
    }
}
