<?php

namespace App\Imports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\ToModel;

class ExpensesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Mapeo de filas del Excel al modelo Expense
        return new Expense([
            'name' => $row[0],
            'amount' => $row[1],
            'created_at' => $row[2],
        ]);
    }
}
