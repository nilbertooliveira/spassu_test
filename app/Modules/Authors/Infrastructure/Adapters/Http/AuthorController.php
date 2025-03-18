<?php

namespace App\Modules\Authors\Infrastructure\Adapters\Http;

use App\Http\Controllers\Controller;
use App\Modules\Authors\Application\DTOs\AuthorDto;
use App\Modules\Authors\Application\UseCases\CreateAuthorUseCase;
use App\Modules\Authors\Application\UseCases\DeleteAuthorUseCase;
use App\Modules\Authors\Application\UseCases\GetAuthorUseCase;
use App\Modules\Authors\Application\UseCases\ListAuthorsUseCase;
use App\Modules\Authors\Application\UseCases\UpdateAuthorUseCase;
use App\Modules\Authors\Infrastructure\Adapters\Http\Requests\AuthorRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    private ListAuthorsUseCase $listAuthorsUseCase;
    private GetAuthorUseCase $getAuthorUseCase;
    private CreateAuthorUseCase $createAuthorUseCase;
    private UpdateAuthorUseCase $updateAuthorUseCase;
    private DeleteAuthorUseCase $deleteAuthorUseCase;

    public function __construct(
        ListAuthorsUseCase  $listAuthorsUseCase,
        GetAuthorUseCase    $getAuthorUseCase,
        CreateAuthorUseCase $createAuthorUseCase,
        UpdateAuthorUseCase $updateAuthorUseCase,
        DeleteAuthorUseCase $deleteAuthorUseCase
    )
    {
        $this->listAuthorsUseCase = $listAuthorsUseCase;
        $this->getAuthorUseCase = $getAuthorUseCase;
        $this->createAuthorUseCase = $createAuthorUseCase;
        $this->updateAuthorUseCase = $updateAuthorUseCase;
        $this->deleteAuthorUseCase = $deleteAuthorUseCase;
    }


    public function index(): View
    {
        $authorDto = $this->listAuthorsUseCase->execute();

        $authors = AuthorDto::toArray($authorDto);

        return view('authors.index', compact('authors'));
    }


    public function create(): View
    {
        return view('authors.create');
    }


    public function edit(int $id): View
    {
        $authorDto = $this->getAuthorUseCase->execute($id);

        $author = AuthorDto::toArray([$authorDto]);

        return view('authors.edit')->with('author', $author[0]);
    }


    public function store(AuthorRequest $request): RedirectResponse
    {
        $authorDto = new AuthorDto(
            name: $request->name,
        );

        $this->createAuthorUseCase->execute($authorDto);

        AuthorDto::toArray([$authorDto]);

        return redirect()->route('authors.index');
    }


    public function update(AuthorRequest $request, int $id): RedirectResponse
    {
        $authorDto = new AuthorDto(
            name: $request->name,
            id: $id,
        );
        $this->updateAuthorUseCase->execute($authorDto);

        return redirect()->route('authors.index');
    }


    public function destroy(int $id): RedirectResponse
    {
        $this->deleteAuthorUseCase->execute($id);

        return redirect()->route('authors.index');
    }
}
