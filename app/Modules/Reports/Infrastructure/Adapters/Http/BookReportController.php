<?php

namespace App\Modules\Reports\Infrastructure\Adapters\Http;

use App\Http\Controllers\Controller;
use App\Modules\Reports\Application\Jobs\GenerateBooksReportJob;

class BookReportController extends Controller
{
    public function __construct()
    {
    }

    public function generate(): void
    {
        GenerateBooksReportJob::dispatch();
    }
}
