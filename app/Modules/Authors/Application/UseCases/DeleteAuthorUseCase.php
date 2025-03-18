<?php

namespace App\Modules\Authors\Application\UseCases;

use App\Modules\Authors\Domain\Repositories\AuthorRepositoryInterface;

class DeleteAuthorUseCase
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(int $id): bool
    {
        return $this->authorRepository->delete($id);

    }
}
