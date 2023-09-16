<?php

namespace App\Http\Controllers\Employee;

use App\Facades\EmployeeFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\ImportEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function store(ImportEmployeeRequest $request)
    {
        try {
            EmployeeFacade::importEmployees($request->file('file'));
            return response()->json('Your file is importing. The rows have errors will logged!', Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
            return response()->json('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index(Request $request)
    {
        try {
            $employees = EmployeeFacade::getAllEmployees($request);
            return response()->json($employees, Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
            return response()->json('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        $employee = EmployeeFacade::getEmployee($id);
        try {
            return response()->json($employee, Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
            return response()->json('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        EmployeeFacade::deleteEmployee($id);
        try {
            return response()->json('The employee successfully deleted!', Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
            return response()->json('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
