<?php

namespace App\Modules\Reports\Application\Jobs;

use App\Modules\Reports\Application\Events\ReportGeneratedEvent;
use App\Modules\Reports\Application\UseCases\GeneratePdfUseCase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateBooksReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {

    }

    public function handle(GeneratePdfUseCase $generatePdfUseCase): void
    {
        $url = $generatePdfUseCase->execute();

        broadcast(new ReportGeneratedEvent($url));
    }
}
