<?php

namespace App\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getById($id);

    public function get($request);

    public function delete($employee);
}
