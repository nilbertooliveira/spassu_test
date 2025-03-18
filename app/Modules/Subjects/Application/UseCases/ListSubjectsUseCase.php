<?php

namespace App\Modules\Subjects\Application\UseCases;

use App\Modules\Authors\Application\DTOs\AuthorDto;
use App\Modules\Subjects\Application\DTOs\SubjectDto;
use App\Modules\Subjects\Domain\Repositories\SubjectRepositoryInterface;

class ListSubjectsUseCase
{


    private SubjectRepositoryInterface $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {

        $this->subjectRepository = $subjectRepository;
    }

    /**
     * @return AuthorDto[]
     */
    public function execute(): array
    {
        $data = $this->subjectRepository->all();
        return SubjectDto::fromEntities($data);
    }

}
