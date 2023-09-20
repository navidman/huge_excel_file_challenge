<?php

namespace Tests\Feature;


use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_can_be_shown_by_id()
    {
        $employee = Employee::factory()->count(1)->create();
        $response = $this->get('api/employee/'. $employee[0]['id']);
        $response->assertStatus(200);
        $response->assertSee($employee[0]['username']);
        $response->assertJson([
            'data' => [],
        ]);
    }
}
