<?php

namespace App\Jobs;

use App\Imports\EmployeesImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProcessEmployeeImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;

    /**
     * Create a new job instance.
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $import = new EmployeesImport();
        $import->import($this->file);
        if($import->failures()->isNotEmpty())
        {
            foreach ($import->failures() as $failure) {
                Log::info($failure->row());
            }
        }

//        $import = Excel::import(new EmployeesImport(), );
//        $errors = $import->getErrors();
//
//        foreach ($errors as $error) {
//            Log::info($error);
//        }

    }
}
