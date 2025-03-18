<?php

namespace App\Modules\Books\Infrastructure\Repositories;


use App\Modules\Authors\Domain\Entities\AuthorEntity;
use App\Modules\Books\Domain\Entities\BookEntity;
use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;
use App\Modules\Books\Infrastructure\Models\Book;
use App\Modules\Subjects\Domain\Entities\SubjectEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;


class BookRepository implements BookRepositoryInterface
{

    /**
     * @var Book|Builder
     */
    private Book|Builder $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    /**
     * @return BookEntity[]
     */
    public function all(): array
    {
        $data = $this->model->with(['authors', 'subjects'])->get();
        return BookEntity::fromCollection($data);
    }

    /**
     * @param int $id
     * @return BookEntity
     */
    public function find(int $id): BookEntity
    {
        try {
            /**  @var Book $data */
            $data = $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Livro com identificador $id não foi encontrado!");
        }
        return new BookEntity(
            title: $data->Titulo,
            publisher: $data->Editora,
            edition: $data->Edicao,
            yearPublication: $data->AnoPublicacao,
            price: $data->Valor,
            authors: AuthorEntity::fromCollection($data->authors),
            subjects: SubjectEntity::fromCollection($data->subjects),
            createdAt: $data->created_at,
            updatedAt: $data->updated_at,
            id: $data->Codl,
        );
    }

    public function store(BookEntity $data): BookEntity
    {
        $result = $this->model->create(
            [
                'Titulo' => $data->getTitle(),
                'Editora' => $data->getPublisher(),
                'Edicao' => $data->getEdition(),
                'AnoPublicacao' => $data->getYearPublication(),
                'Valor' => $data->getPrice(),
            ]
        );
        return $this->createBookEntityFromResult($data, $result);
    }

    public function update(BookEntity $data, int $id): BookEntity
    {
        try {
            /**  @var Book $data */
            $model = $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Livro com identificador $id não foi encontrado!");
        }
        $values = [
            'Titulo' => $data->getTitle(),
            'Editora' => $data->getPublisher(),
            'Edicao' => $data->getEdition(),
            'AnoPublicacao' => $data->getYearPublication(),
            'Valor' => $data->getPrice(),
        ];
        $model->update($values);

        return $this->createBookEntityFromResult($data, $model->fresh());
    }

    /**
     * @param BookEntity $data
     * @param Book $book
     * @return BookEntity
     */
    public function createBookEntityFromResult(BookEntity $data, Book $book): BookEntity
    {
        $book->authors()->sync($data->getAuthors());
        $book->subjects()->sync($data->getSubjects());

        return new BookEntity(
            title: $book->Titulo,
            publisher: $book->Editora,
            edition: $book->Edicao,
            yearPublication: $book->AnoPublicacao,
            price: $book->Valor,
            authors: AuthorEntity::fromCollection($book->authors),
            subjects: SubjectEntity::fromCollection($book->subjects),
            createdAt: $book->created_at,
            updatedAt: $book->updated_at,
            id: $book->Codl,
        );
    }

    /**
     * @throws Throwable
     */
    public function delete(int $id): ?bool
    {
        try {
            /**  @var Book $data */
            $model = $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Livro com identificador $id não foi encontrado!");
        }
        return $model->delete();
    }
}
