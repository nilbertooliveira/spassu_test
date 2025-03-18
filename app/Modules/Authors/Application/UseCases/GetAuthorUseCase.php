<?php

namespace App\Modules\Authors\Application\UseCases;

use App\Modules\Authors\Application\DTOs\AuthorDto;
use App\Modules\Authors\Domain\Repositories\AuthorRepositoryInterface;

class GetAuthorUseCase
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(int $id): AuthorDto
    {
        $authorEntity = $this->authorRepository->find($id);
        return new AuthorDto(name: $authorEntity->getName(), id: $authorEntity->getId());
    }
}
