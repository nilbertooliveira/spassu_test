<?php

namespace App\Modules\Authors\Application\UseCases;

use App\Modules\Authors\Application\DTOs\AuthorDto;
use App\Modules\Authors\Domain\Entities\AuthorEntity;
use App\Modules\Authors\Domain\Repositories\AuthorRepositoryInterface;

class UpdateAuthorUseCase
{
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(AuthorDto $authorDto): AuthorDto
    {
        $authorEntity = new AuthorEntity(
            name: $authorDto->getName(),
            createdAt: now(),
            updatedAt: now(),
            id: $authorDto->getId()
        );
        $data = $this->authorRepository->update($authorEntity);

        return new AuthorDto(name: $data->getName(), id: $data->getId());
    }
}
