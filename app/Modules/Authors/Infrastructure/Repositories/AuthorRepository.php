<?php


namespace App\Modules\Authors\Infrastructure\Repositories;

use App\Modules\Authors\Domain\Entities\AuthorEntity;
use App\Modules\Authors\Domain\Repositories\AuthorRepositoryInterface;
use App\Modules\Authors\Infrastructure\Models\Author;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class AuthorRepository implements AuthorRepositoryInterface
{

    private Author|Builder $model;

    public function __construct(Author $model)
    {
        $this->model = $model;
    }

    /**
     * @return AuthorEntity[]
     */
    public function all(): array
    {
        return AuthorEntity::fromCollection($this->model->all());
    }

    /**
     * @param int $id
     * @return AuthorEntity
     */
    public function find(int $id): AuthorEntity
    {
        try {
            /**  @var Author $data */
            $data = $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Author com identificador $id não foi encontrado!");
        }
        return new AuthorEntity(
            name: $data->Nome,
            createdAt: $data->created_at,
            updatedAt: $data->updated_at,
            id: $data->CodAu
        );
    }

    public function store(AuthorEntity $data): AuthorEntity
    {
        $result = $this->model->create(
            [
                'Nome' => $data->getName(),
            ]
        );
        return new AuthorEntity(
            name: $result->Nome,
            createdAt: $result->created_at,
            updatedAt: $result->updated_at,
            id: $result->CodAu
        );
    }

    public function update(AuthorEntity $data): AuthorEntity
    {
        try {
            /**  @var Author $result */
            $result = $this->model->findOrFail($data->getId());
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Author com identificador {$data->getId()} não foi encontrado!");
        }

        $values = [
            'Nome' => $data->getName(),
        ];

        $result->update($values);

        return new AuthorEntity(
            name: $result->Nome,
            createdAt: $result->created_at,
            updatedAt: $result->updated_at,
            id: $result->CodAu
        );
    }

    /**
     * @throws Throwable
     */
    public function delete(int $id): ?bool
    {
        try {
            /**  @var Author $model */
            $model = $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Author com identificador $id não foi encontrado!");
        }
        return $model->delete();
    }
}
