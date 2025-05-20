<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Models\Payslip;
use Illuminate\Support\Facades\Auth;

class PayslipDaysExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithEvents
{
    public function collection()
    {
        return Payslip::where('user_id', Auth::id())->get();
    }

    // public function map($payslip): array
    // {
    //     $worker = $payslip->salary->worker;
    //     $attendanceCount = $worker->attendance->count(); // Count attendance days
    //     $attendanceAmount = $worker->salary->daily_earnings * $attendanceCount;

    //     return [
    //         $worker->name,
    //         $payslip->created_at->format('M Y'),
    //         $worker->department->name,
    //         $attendanceCount,  // Days attended
    //         $payslip->prepared_by,
    //         $payslip->created_at->format('d M Y, H:i'),
    //     ];
    // }
    public function map($payslip): array
{
    $worker = $payslip->salary->worker;

    // If attendance relation exists, count it; otherwise default to 0
    $attendanceCount = $worker->attendance ? $worker->attendance->count() : 0;

    // Optionally override to always be 0 (uncomment if needed)
    // $attendanceCount = 0;

    $attendanceAmount = $worker->salary->daily_earnings * $attendanceCount;

    return [
        $worker->name,
        $payslip->created_at->format('M Y'),
        $worker->department->name,
        $attendanceCount ?? '0',  // Days attended
        $payslip->prepared_by,
        $payslip->created_at->format('d M Y, H:i'),
    ];
}


    public function headings(): array
    {
        return [
            "NAME",
            "MONTH",
            "DEPARTMENT",
            "DAYS ATTENDED",
            "PREPARED DATE",
            "PREPARED BY",
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER, // Ensure Account Number is correctly formatted
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Auto-size all columns
                foreach (range('A', 'G') as $columnID) {
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Apply bold styling to the header row (A1:G1)
                $event->sheet->getDelegate()->getStyle('A1:G1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
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
