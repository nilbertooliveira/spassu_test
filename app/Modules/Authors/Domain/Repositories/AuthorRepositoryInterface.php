<?php

namespace App\Modules\Authors\Domain\Repositories;

use App\Modules\Authors\Domain\Entities\AuthorEntity;

interface AuthorRepositoryInterface
{
    /**
     * @return AuthorEntity[]
     */
    public function all(): array;

    public function find(int $id): AuthorEntity;

    public function store(AuthorEntity $data): AuthorEntity;

    public function update(AuthorEntity $data): AuthorEntity;

    public function delete(int $id): ?bool;
}
