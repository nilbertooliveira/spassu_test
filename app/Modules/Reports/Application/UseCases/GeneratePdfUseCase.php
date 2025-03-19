<?php

namespace App\Modules\Reports\Application\UseCases;

use App\Modules\Reports\Domain\Entities\ReportEntity;
use App\Modules\Reports\Domain\Repositories\ReportRepositoryInterface;
use FPDF;
use Illuminate\Support\Facades\Storage;

class GeneratePdfUseCase
{
    private ReportRepositoryInterface $reportRepository;
    private string $pdfFilePath;
    private string $url;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;

        $fileName = now()->format('Y_m_d_H_i_s') . '_report.pdf';
        $this->pdfFilePath = Storage::disk('public')->path($fileName);
        $this->url = url(Storage::url($fileName));
    }

    public function execute(): string
    {
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->AddPage();
        $pdf->Cell(40, 10, 'Books Report!', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->Cell(60, 10, utf8_decode('Autores'), 1, 0, 'C');
        $pdf->Cell(50, 10, utf8_decode('Título'), 1, 0, 'C');
        $pdf->Cell(50, 10, utf8_decode('Editora'), 1, 0, 'C');
        $pdf->Cell(15, 10, utf8_decode('Ano'), 1, 0, 'C');
        $pdf->Cell(15, 10, utf8_decode('Edição'), 1, 0, 'C');
        $pdf->Cell(20, 10, utf8_decode('Preço'), 1, 0, 'C');
        $pdf->Cell(70, 10, utf8_decode('Assuntos'), 1, 1, 'C');

        $pdf->SetFont('Arial', '', 8);

        $this->reportRepository->getAllAsEntitiesChunked(2, function ($entities) use ($pdf) {
            /** @var ReportEntity $entity */
            foreach ($entities as $entity) {
                $x = $pdf->GetX();
                $y = $pdf->GetY();
                $w = 60;
                $pdf->MultiCell($w, 10, utf8_decode($entity->getAuthor()), 1, 'L');

                $height = $pdf->GetY() - $y;

                $pdf->SetXY($x + $w, $y);

                $pdf->Cell(50, $height, utf8_decode($entity->getTitle()), 1, 0);
                $pdf->Cell(50, $height, utf8_decode($entity->getPublisher()), 1, 0);
                $pdf->Cell(15, $height, utf8_decode($entity->getYearPublication()), 1, 0);
                $pdf->Cell(15, $height, utf8_decode($entity->getEdition()), 1, 0);
                $pdf->Cell(20, $height, utf8_decode('R$ ' . number_format($entity->getPrice(), 2, ',', '.')), 1, 0);
                $pdf->MultiCell(70, $height, utf8_decode($entity->getSubjects()), 1, 'L');
            }
        });
        $pdf->Output('F', $this->pdfFilePath);

        return $this->url;
    }

}
