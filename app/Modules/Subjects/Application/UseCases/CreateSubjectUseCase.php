<?php

namespace App\Modules\Subjects\Application\UseCases;

use App\Modules\Subjects\Application\DTOs\SubjectDto;
use App\Modules\Subjects\Domain\Entities\SubjectEntity;
use App\Modules\Subjects\Domain\Repositories\SubjectRepositoryInterface;

class CreateSubjectUseCase
{
    private SubjectRepositoryInterface $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function execute(SubjectDto $subjectDto): SubjectDto
    {
        $subjectEntity = new SubjectEntity(
            description: $subjectDto->getDescription(),
            createdAt: now(),
            updatedAt: now()
        );
        $data = $this->subjectRepository->store($subjectEntity);

        return new SubjectDto(description: $data->getDescription(), id: $data->getId());
    }
}
