<?php

namespace Tests\Unit;

use App\Imports\EmployeesImport;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class EmployeeImportTest extends TestCase
{
    use RefreshDatabase;
    public function test_employees_can_be_imported()
    {
        Excel::fake();
        $this->get('/employee/excel/csv');
//        $import = new EmployeesImport();
//        $import->import('employee/excel/import.csv');

        Excel::assertImported('employee/excel/import.csv', 'public');

        Excel::assertImported('employee/excel/import.csv', 'public', function(EmployeesImport $import) {
            return true;
        });

        // When passing the callback as 2nd param, the disk will be the default disk.
        Excel::assertImported('employee/excel/import.csv', function(EmployeesImport $import) {
            return true;
        });
    }
}
