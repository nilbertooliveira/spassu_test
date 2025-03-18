<?php

namespace App\Modules\Books\Infrastructure\Adapters\Http;

use App\Http\Controllers\Controller;
use App\Modules\Authors\Application\DTOs\AuthorDto;
use App\Modules\Authors\Application\UseCases\ListAuthorsUseCase;
use App\Modules\Books\Application\DTOs\BookDto;
use App\Modules\Books\Application\UseCases\CreateBookUseCase;
use App\Modules\Books\Application\UseCases\DeleteBookUseCase;
use App\Modules\Books\Application\UseCases\GetBookUseCase;
use App\Modules\Books\Application\UseCases\ListBooksUseCase;
use App\Modules\Books\Application\UseCases\UpdateBookUseCase;
use App\Modules\Books\Infrastructure\Adapters\Http\Requests\BookRequest;
use App\Modules\Subjects\Application\DTOs\SubjectDto;
use App\Modules\Subjects\Application\UseCases\ListSubjectsUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    private ListBooksUseCase $listBooksUseCase;
    private GetBookUseCase $getBookUseCase;
    private CreateBookUseCase $createBookUseCase;
    private UpdateBookUseCase $updateBookUseCase;
    private DeleteBookUseCase $deleteBookUseCase;
    private ListAuthorsUseCase $listAuthorsUseCase;
    private ListSubjectsUseCase $listSubjectsUseCase;

    public function __construct(
        ListBooksUseCase    $listBooksUseCase,
        GetBookUseCase      $getBookUseCase,
        CreateBookUseCase   $createBookUseCase,
        UpdateBookUseCase   $updateBookUseCase,
        DeleteBookUseCase   $deleteBookUseCase,
        ListAuthorsUseCase  $listAuthorsUseCase,
        ListSubjectsUseCase $listSubjectsUseCase
    )
    {
        $this->listBooksUseCase = $listBooksUseCase;
        $this->getBookUseCase = $getBookUseCase;
        $this->createBookUseCase = $createBookUseCase;
        $this->updateBookUseCase = $updateBookUseCase;
        $this->deleteBookUseCase = $deleteBookUseCase;
        $this->listAuthorsUseCase = $listAuthorsUseCase;
        $this->listSubjectsUseCase = $listSubjectsUseCase;
    }

    public function index(): View
    {
        $booksDto = $this->listBooksUseCase->execute();

        $data = BookDto::toArray($booksDto);

        return view('books.index')->with('books', $data);
    }

    public function edit(int $id): View
    {
        $bookDto = $this->getBookUseCase->execute($id);

        $data = BookDto::toArray([$bookDto]);

        $authorsDto = $this->listAuthorsUseCase->execute();
        $subjectsDto = $this->listSubjectsUseCase->execute();

        $authors = AuthorDto::toArray($authorsDto);
        $subjects = SubjectDto::toArray($subjectsDto);

        return view('books.edit')->with('books', $data[0])
            ->with('authors', $authors)
            ->with('subjects', $subjects);
    }


    public function create(): View
    {
        $authorsDto = $this->listAuthorsUseCase->execute();
        $subjectsDto = $this->listSubjectsUseCase->execute();

        $authors = AuthorDto::toArray($authorsDto);
        $subjects = SubjectDto::toArray($subjectsDto);

        return view('books.create')
            ->with('authors', $authors)
            ->with('subjects', $subjects);
    }

    public function store(BookRequest $request): RedirectResponse
    {
        $BookDto = new BookDto(
            title: $request->title,
            publisher: $request->publisher,
            edition: $request->edition,
            yearPublication: $request->yearPublication,
            price: $request->price,
            authors: $request->authors,
            subjects: $request->subjects,
        );

        $this->createBookUseCase->execute($BookDto);

        return redirect()->route('books.index');
    }

    public function update(BookRequest $request, int $id): RedirectResponse
    {
        $BookDto = new BookDto(
            title: $request->title,
            publisher: $request->publisher,
            edition: $request->edition,
            yearPublication: $request->yearPublication,
            price: $request->price,
            authors: $request->authors,
            subjects: $request->subjects,
            id: $id
        );

        $this->updateBookUseCase->execute($BookDto);

        return redirect()->route('books.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->deleteBookUseCase->execute($id);

        return redirect()->route('books.index');
    }
}

