<?php

namespace App\Modules\Subjects\Application\UseCases;

use App\Modules\Subjects\Application\DTOs\SubjectDto;
use App\Modules\Subjects\Domain\Repositories\SubjectRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class ListSubjectsPaginatedUseCase
{
    private SubjectRepositoryInterface $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function execute(int $perPage = 10): Paginator
    {
        return $this->subjectRepository->paginated($perPage);
    }
}
