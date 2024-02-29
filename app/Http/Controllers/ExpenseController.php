<?php

namespace App\Http\Controllers;

use App\Imports\ExpensesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExpenseController extends Controller
{
    public function importExcel(Request $request)
    {
        // Validación del archivo subido y su formato
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        // Importación de archivo utilizando la clase ExpensesImport
        Excel::import(new ExpensesImport, $request->file('file'));

        // Respuesta a la petición
        return redirect('/')->with('success', 'Archivo importado exitosamente');
    }
}
