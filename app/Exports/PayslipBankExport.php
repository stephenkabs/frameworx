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

class PayslipBankExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, WithEvents

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

        return [
            $this->index, // Serial number starting from 1
            $payslip->salary->worker->name,
            (string) $payslip->salary->worker->account_number,
            $payslip->salary->worker->bank_name,
            $payslip->salary->worker->branch_location,
            (string) $payslip->salary->worker->bank_code,
            $netPay,
        ];
    }

    public function headings(): array
    {
        return ["S/N", "NAME", "ACCOUNT NO", "BANK NAME", "BRANCH NAME", "BRANCH CODE", "AMOUNT" ];
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

