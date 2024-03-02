<?php

namespace App\Http\Controllers;

use App\Imports\ExpensesImport;
use App\Jobs\NotifyUserOfCompletedImport;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function uploadFileView()
    {
        return view('upload_file');
    }
    
    public function importExcel(Request $request)
    {
        try {
            // Validación del archivo subido y su formato
            $request->validate([
                'file' => 'required|mimes:xlsx'
            ]);

            // Encolar la tarea de importación
            (new ExpensesImport(request()->user()))->queue($request->file('file'))->chain([
                // Acción en cadena que se ejecuta cuando la tarea finalizó exitosamente
                new NotifyUserOfCompletedImport(request()->user()),
            ]);

            // Respuesta a la petición
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Archivo agregado a la cola de trabajo. Recibirá un email notificandole que ha sido procesado.'], 200);
            } else {
                return redirect('expense/upload-file')->with('success', 'Archivo agregado a la cola de trabajo. Recibirá un email notificandole que ha sido procesado.');
            }
        } catch (\Throwable $th) {
            if ($request->wantsJson()) {
                return response()->json(['message' => $th->getMessage()], 500);
            } else {
                return redirect('expense/upload-file')->with('error', $th->getMessage());
            }
        }
    }
}
