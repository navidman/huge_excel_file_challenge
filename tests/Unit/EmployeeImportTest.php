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

        $file = UploadedFile::fake()->create('import.csv', 1000, ['csv', 'txt']);

        $response = (new EmployeesImport)->import($file);

        Excel::assertImported('import.csv', 'public');

        // You can add more assertions based on your specific requirements
        // For example, check if the records are inserted in the database
        $this->assertDatabaseHas('employees', [
            // Provide the attributes you expect to be in the database
            "employee_id" => 198429,
            "username" => "sibumgarner",
            "name_prefix" => "Mrs.",
            "first_name" => "Serafina",
            "middle_initial" => "I",
            "last_name" => "Bumgarner",
            "gender" => "F",
            "email" => "serafina.bumgarner@exxonmobil.com",
            "date_of_birth" => "1982-09-21",
            "time_of_birth" => "01:53:14",
            "age_in_years" => 34.87,
            "date_of_joining" => "2008-02-01",
            "age_in_company" => 9.49,
            "phone_no" => "212-376-9125",
            "place_name" => "Clymer",
            "country" => "Chautauqua",
            "city" => "Clymer",
            "zip" => "14724",
            "region" => "Northeast",
            // Add more attributes as needed
        ]);
    }
}
