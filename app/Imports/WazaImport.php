<?php

namespace App\Imports;

use App\Models\Waza;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class WazaImport implements ToModel
{
    public function model(array $row)
    {
        // Skip header row
        if ($row[0] === 'name') {
            return null;
        }

        return new Waza([
            'name' => $row[0],
            'position' => $row[1],
            'net_pay' => $row[2],
            'accuedle_days' => $row[3],
            'leave_days_taken' => $row[4],
            'worked_days' => $row[5],
            'term_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]),
            'comment' => $row[7],
            'user_id' => Auth::id(),
        ]);
    }
}
