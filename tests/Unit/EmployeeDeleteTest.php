<?php

namespace Tests\Unit;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeDeleteTest extends TestCase
{
    use RefreshDatabase;
    public function test_employee_can_be_deleted()
    {
        $employee =  Employee::factory()->count(1)->create();
        $this->assertEquals(1, Employee::count());
        $response = $this->delete('api/employee/'. $employee[0]['id']);
        $response->assertStatus(200);
        $this->assertEquals(0, Employee::count());
    }
}
