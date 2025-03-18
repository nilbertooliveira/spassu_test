<?php

namespace App\Modules\Subjects\Domain\Repositories;

use App\Modules\Subjects\Domain\Entities\SubjectEntity;

interface SubjectRepositoryInterface
{
    /**
     * @return SubjectEntity[]
     */
    public function all(): array;

    public function find(int $id): SubjectEntity;

    public function store(SubjectEntity $data): SubjectEntity;

    public function update(SubjectEntity $data): SubjectEntity;

    public function delete(int $id): ?bool;
}
