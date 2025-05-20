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


class PayslipMobileExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, WithEvents
{
    public function collection()
    {
        return Payslip::where('user_id', Auth::id())->get();
    }

    protected $index = 0; // Counter for serial number

    public function map($payslip): array
    {
        $this->index++; // Increment for each row

        $totalAdvance = $payslip->salary->worker->advance
            ? $payslip->salary->worker->advance->sum('amount')
            : 0;
        $netPay = $payslip->salary->net_pay - $totalAdvance;
        $gross = $payslip->salary->basic_salary + $payslip->salary->other_allowance + $payslip->salary->other_allowance_two +
        $payslip->salary->transport_allowance + $payslip->salary->housing_allowance;

        return [
            $this->index, // Serial number starting from 1
            $payslip->salary->worker->name,
            $payslip->salary->worker->designation,
            (string) $payslip->salary->worker->mm_number,
            $payslip->salary->worker->mm_name,
            $gross,
            $netPay,
        ];
    }

    public function headings(): array
    {
        return ["S/N", "NAME", "JOB DESCRIPTION", "MOBILE NUMBER", "MOBILE NAMES", "MONTH PAY" , 'NET PAY'];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER, // Ensure Account Number is correctly formatted
        ];
    }



    // Make headings bold and auto-size columns
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Auto-size all columns
                foreach (range('A', 'K') as $columnID) {
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }

                // Apply bold styling to the header row (A1:J1)
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
