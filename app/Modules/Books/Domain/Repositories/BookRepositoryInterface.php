<?php

namespace App\Modules\Books\Domain\Repositories;

use App\Modules\Books\Domain\Entities\BookEntity;

interface BookRepositoryInterface
{
    /**
     * @return BookEntity[]
     */
    public function all(): array;

    public function find(int $id): BookEntity;

    public function store(BookEntity $data): BookEntity;

    public function update(BookEntity $data, int $id): BookEntity;

    public function delete(int $id): ?bool;
}
