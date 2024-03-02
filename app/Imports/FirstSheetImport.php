<?php

namespace App\Imports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class FirstSheetImport implements ToModel, WithHeadingRow, WithUpserts
{
    protected $_userId;

    public function __construct ($userId)
    {
        $this->_userId = $userId;
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        // Actualiza el registro si el valor del campo name de la tabla expenses
        // ya existe en la columna gasto del archivo excel
        return 'name';
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|Expense
    */
    public function model(array $row)
    {
        // Mapeo de filas del Excel al modelo Expense
        return new Expense([
            'name' => $row['gasto'],
            'amount' => $row['monto'],
            'user_id' => $this->_userId,
            'created_at' => Date::excelToDateTimeObject($row['fecha']),
        ]);
    }
}
