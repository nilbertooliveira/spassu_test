<?php

namespace App\Modules\Subjects\Application\UseCases;

use App\Modules\Subjects\Application\DTOs\SubjectDto;
use App\Modules\Subjects\Domain\Repositories\SubjectRepositoryInterface;

class GetSubjectUseCase
{
    private SubjectRepositoryInterface $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function execute(int $id): SubjectDto
    {
        $subjectEntity = $this->subjectRepository->find($id);

        return new SubjectDto(description: $subjectEntity->getDescription(), id: $subjectEntity->getId());
    }
}
