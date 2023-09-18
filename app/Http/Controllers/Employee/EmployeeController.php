<?php

namespace App\Http\Controllers\Employee;

use App\Exceptions\ImportFailedException;
use App\Facades\EmployeeFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\ImportEmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function store(ImportEmployeeRequest $request)
    {
        try {
            EmployeeFacade::importEmployees($request->file('file'));
            return response()->json('Your file is importing. The rows have errors will logged on import_failed channel!', Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            throw new ImportFailedException('File import failed.', Response::HTTP_INTERNAL_SERVER_ERROR, $throwable);
        }
    }

    public function index(Request $request)
    {
        $employees = EmployeeFacade::getAllEmployees($request);
        return new EmployeeCollection($employees);

    }

    public function show($id)
    {
        $employee = EmployeeFacade::getEmployee($id);
        return new EmployeeResource($employee);
    }

    public function destroy($id)
    {
        EmployeeFacade::deleteEmployee($id);
        return response()->json('The employee successfully deleted!', Response::HTTP_OK);
    }
}
