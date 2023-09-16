<?php

namespace App\Services;

use App\Imports\EmployeesImport;
use App\Jobs\ProcessEmployeeImportJob;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function importEmployees($file)
    {
        $filePath = $this->uploadFile($file);
        return ProcessEmployeeImportJob::dispatch(Storage::disk('public')->path($filePath));
    }

    private function uploadFile($file)
    {
        $file_name = $file->getClientOriginalName();
        $path = 'employee/excel';
        $filePath = Storage::disk('public')->putFileAs(
            $path,
            $file,
            $file_name
        );
        return $filePath;
    }

    public function getAllEmployees($request)
    {
        $employees = $this->employeeRepository->get($request);
        return $employees;
    }

    public function getEmployee($id)
    {
        $employee = $this->employeeRepository->getById($id);
        return $employee;
    }

    public function deleteEmployee($id)
    {
        $employee = $this->employeeRepository->getById($id);
        return $this->employeeRepository->delete($employee);
    }

}
