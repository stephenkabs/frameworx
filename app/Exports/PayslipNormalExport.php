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
use PhpOffice\PhpSpreadsheet\Style\Font;
use App\Models\Payslip;
use Illuminate\Support\Facades\Auth;

class PayslipNormalExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithEvents
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

        $gross = $payslip->salary->basic_salary + $payslip->salary->other_allowance + $payslip->salary->other_allowance_two +
        $payslip->salary->transport_allowance + $payslip->salary->housing_allowance;

        return [
            $payslip->salary->worker->name,
            $payslip->salary->worker->tracking_code,
            $payslip->salary->worker->nrc,
            (string) $payslip->salary->worker->nhima_no,
            (string) $payslip->salary->worker->napsa_no,
            $gross,
            $payslip->salary->napsa,
            $payslip->salary->nhima,
            $payslip->salary->payee,
            $payslip->salary->net_pay,
            $payslip->prepared_by,
            $payslip->created_at->format('d M Y, H:i'),
        ];
    }

    public function headings(): array
    {
        return ["Employee Name", "Employee MAN ID", "NRC", "NHIMA No", "NAPSA No", "Gross Pay", "NAPSA Contribution", "NHIMA Contribution","PAYEE Contribution","Net Pay",  "Prepared By","Payment Date" ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER, // Ensure Account Number is correctly formatted
        ];
    }



    // Make headings bold and auto-size columns
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Auto-size all columns
                foreach (range('A', 'L') as $columnID) {
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Apply bold styling to the header row (A1:J1)
                $event->sheet->getDelegate()->getStyle('A1:L1')->applyFromArray([
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
