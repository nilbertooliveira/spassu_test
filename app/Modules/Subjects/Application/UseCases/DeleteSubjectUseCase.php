<?php

namespace App\Modules\Subjects\Application\UseCases;

use App\Modules\Subjects\Domain\Repositories\SubjectRepositoryInterface;

class DeleteSubjectUseCase
{
    private SubjectRepositoryInterface $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function execute(int $id): bool
    {
        return $this->subjectRepository->delete($id);
    }
}
