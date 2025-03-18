<?php

namespace App\Modules\Authors\Application\UseCases;

use App\Modules\Authors\Application\DTOs\AuthorDto;
use App\Modules\Authors\Domain\Repositories\AuthorRepositoryInterface;

class ListAuthorsUseCase
{

    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return AuthorDto[]
     */
    public function execute(): array
    {
        $data = $this->authorRepository->all();

        return AuthorDto::fromEntities($data);
    }

}
