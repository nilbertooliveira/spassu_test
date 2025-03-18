<?php

namespace App\Modules\Reports\Domain\Repositories;

use App\Modules\Reports\Domain\Entities\ReportEntity;

interface ReportRepositoryInterface
{
    public function getAllAsEntitiesChunked(int $chunkSize, callable $callback): void;
}
