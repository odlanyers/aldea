<?php

namespace App\Imports;

use App\Models\User;
use App\Notifications\ImportHasFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\ImportFailed;

class ExpensesImport implements WithMultipleSheets, ShouldQueue, WithChunkReading, WithEvents
{
    use Importable;

    protected $userId;

    protected $importedBy;

    public function __construct (User $importedBy)
    {
        $this->userId = $importedBy->id;
        $this->importedBy = $importedBy;
    }

    /**
     * @return array classes
     * 
     * Filtra solo la primer hoja del archivo para ser importada
     */
    public function sheets(): array
    {
        return [
            new FirstSheetImport($this->userId),
        ];
    }

    public function chunkSize(): int
    {
        return 5;
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function(ImportFailed $event) {
                $this->importedBy->notify(new ImportHasFailedNotification);
            },
        ];
    }
}
