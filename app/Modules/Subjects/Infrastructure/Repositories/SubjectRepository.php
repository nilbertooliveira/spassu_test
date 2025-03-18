<?php


namespace App\Modules\Subjects\Infrastructure\Repositories;


use App\Modules\Subjects\Domain\Entities\SubjectEntity;
use App\Modules\Subjects\Domain\Repositories\SubjectRepositoryInterface;
use App\Modules\Subjects\Infrastructure\Models\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class SubjectRepository implements SubjectRepositoryInterface
{

    private Subject|Builder $model;

    public function __construct(Subject $model)
    {
        $this->model = $model;
    }

    public function all(): array
    {
        return SubjectEntity::fromCollection($this->model->all());
    }

    /**
     * @param int $id
     * @return SubjectEntity
     */
    public function find(int $id): SubjectEntity
    {
        try {
            /**  @var Subject $model */
            $data = $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Asaunto com identificador $id não foi encontrado!");
        }

        return new SubjectEntity(
            description: $data->Descricao,
            createdAt: $data->created_at,
            updatedAt: $data->updated_at,
            id: $data->codAs
        );
    }

    public function store(SubjectEntity $data): SubjectEntity
    {
        /** @var Subject $result * */
        $result = $this->model->create(
            [
                'Descricao' => $data->getDescription(),
            ]
        );
        return new SubjectEntity(
            description: $result->Descricao,
            createdAt: $result->created_at,
            updatedAt: $result->updated_at,
            id: $result->codAs
        );
    }

    public function update(SubjectEntity $data): SubjectEntity
    {
        try {
            /**  @var Subject $result */
            $result = $this->model->findOrFail($data->getId());
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Asaunto com identificador {$data->getId()} não foi encontrado!");
        }

        $values = [
            'Descricao' => $result->Descricao,
        ];

        $result->update($values);

        return new SubjectEntity(
            description: $result->Descricao,
            createdAt: $result->created_at,
            updatedAt: $result->updated_at,
            id: $result->codAs
        );
    }

    /**
     * @throws Throwable
     */
    public function delete(int $id): ?bool
    {
        try {
            /**  @var Subject $model */
            $model = $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Assunto com identificador $id não foi encontrado!");
        }
        return $model->delete();
    }
}
