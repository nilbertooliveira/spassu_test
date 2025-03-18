<?php

namespace App\Modules\Subjects\Infrastructure\Adapters\Http;

use App\Http\Controllers\Controller;
use App\Modules\Subjects\Application\DTOs\SubjectDto;
use App\Modules\Subjects\Application\UseCases\CreateSubjectUseCase;
use App\Modules\Subjects\Application\UseCases\DeleteSubjectUseCase;
use App\Modules\Subjects\Application\UseCases\GetSubjectUseCase;
use App\Modules\Subjects\Application\UseCases\ListSubjectsUseCase;
use App\Modules\Subjects\Application\UseCases\UpdateSubjectUseCase;
use App\Modules\Subjects\Infrastructure\Adapters\Http\Requests\SubjectRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{


    private ListSubjectsUseCase $listSubjectsUseCase;
    private GetSubjectUseCase $getSubjectUseCase;
    private CreateSubjectUseCase $createSubjectUseCase;
    private UpdateSubjectUseCase $updateSubjectUseCase;
    private DeleteSubjectUseCase $deleteSubjectUseCase;

    public function __construct(
        ListSubjectsUseCase  $listSubjectsUseCase,
        GetSubjectUseCase    $getSubjectUseCase,
        CreateSubjectUseCase $createSubjectUseCase,
        UpdateSubjectUseCase $updateSubjectUseCase,
        DeleteSubjectUseCase $deleteSubjectUseCase,
    )
    {

        $this->listSubjectsUseCase = $listSubjectsUseCase;
        $this->getSubjectUseCase = $getSubjectUseCase;
        $this->createSubjectUseCase = $createSubjectUseCase;
        $this->updateSubjectUseCase = $updateSubjectUseCase;
        $this->deleteSubjectUseCase = $deleteSubjectUseCase;
    }


    public function index(): View
    {
        $subjectDto = $this->listSubjectsUseCase->execute();

        $subjects = SubjectDto::toArray($subjectDto);

        return view('subjects.index', compact('subjects'));
    }


    public function create(): View
    {
        return view('subjects.create');
    }


    public function edit(int $id): View
    {
        $subjectDto = $this->getSubjectUseCase->execute($id);

        $subject = SubjectDto::toArray([$subjectDto]);

        return view('subjects.edit')->with('subject', $subject[0]);
    }


    public function store(SubjectRequest $request): RedirectResponse
    {
        $subjectDto = new SubjectDto(
            description: $request->description,
        );

        $this->createSubjectUseCase->execute($subjectDto);

        SubjectDto::toArray([$subjectDto]);

        return redirect()->route('subjects.index');
    }


    public function update(SubjectRequest $request, int $id): RedirectResponse
    {
        $subjectDto = new SubjectDto(
            description: $request->description,
            id: $id,
        );
        $this->updateSubjectUseCase->execute($subjectDto);

        return redirect()->route('subjects.index');
    }


    public function destroy(int $id): RedirectResponse
    {
        $this->deleteSubjectUseCase->execute($id);

        return redirect()->route('subjects.index');
    }
}
