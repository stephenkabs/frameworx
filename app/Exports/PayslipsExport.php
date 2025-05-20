<?php

namespace App\Exports;

use App\Models\Payslip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Illuminate\Support\Facades\Auth;

class PayslipsExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithEvents
{
    public function collection()
    {
        return Payslip::where('user_id', Auth::id())->get();
    }

    public function map($payslip): array
    {
        $totalAdvance = $payslip->salary->worker->advance
            ? $payslip->salary->worker->advance->sum('amount')
            : 0;
        $netPay = $payslip->salary->net_pay - $totalAdvance;

        return [
            $payslip->salary->worker->name,
            $payslip->salary->worker->tracking_code,
            $payslip->salary->worker->nrc,
            $payslip->created_at->format('d M Y, H:i'),
            $totalAdvance ?? 'No Advance Cut',
            $netPay,
            $payslip->prepared_by,
        ];
    }

    public function headings(): array
    {
        return ["Employee Name", "Employee MAN ID", "Employee NRC", "Payment Date", "Advance Cut", "Net Pay", "Prepared By"];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER, // Ensure Account Number is correctly formatted
        ];
    }

    // Auto-size columns and make headings bold
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Auto-size all columns
                foreach (range('A', 'K') as $columnID) {
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Apply bold styling to the header row (first row)
                $event->sheet->getDelegate()->getStyle('A1:K1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12, // Optional: Increase font size for better readability
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
