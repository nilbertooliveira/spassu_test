<?php

namespace App\Modules\Reports\Infrastructure\Repositories;

use App\Modules\Reports\Domain\Entities\ReportEntity;
use App\Modules\Reports\Domain\Repositories\ReportRepositoryInterface;
use App\Modules\Reports\Infrastructure\Models\VwBooksReport;
use Illuminate\Database\Eloquent\Builder;

class ReportRepository implements ReportRepositoryInterface
{

    private VwBooksReport|Builder $model;

    public function __construct(VwBooksReport $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $chunkSize
     * @param callable $callback
     * @return void
     */
    public function getAllAsEntitiesChunked(int $chunkSize, callable $callback): void
    {
        $this->model->chunk($chunkSize, function ($chunk) use ($callback) {
            $entities = ReportEntity::fromCollection($chunk);
            $callback($entities);
        });
    }

}
