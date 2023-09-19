<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getByID($id)
    {
        return Employee::where('id', $id)->firstOrFail();
    }
    public function get($request)
    {
        return Employee::
            //Search
            when($request->filled('search'), function ($query) use ($request) {
            $query->where('employee_id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('username', 'LIKE', '%' . $request->search . '%')
                ->orWhere('first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('city', 'LIKE', '%' . $request->search . '%')
                ->orWhere('country', 'LIKE', '%' . $request->search . '%')
                ->orWhere('region', 'LIKE', '%' . $request->search . '%');
            })
            // Filter
            ->when($request->filled('gender') and $request->gender == 'male', function ($query) use ($request) {
                $query->where('gender', '=', 'M');
            })
            ->when($request->filled('gender') and $request->gender == 'female', function ($query) use ($request) {
                $query->where('gender', '=', 'F');
            })
            ->paginate($request->limit ?: 20)
            ->appends(request()->all());
    }

    public function delete($employee)
    {
        return $employee->delete();
    }
}
