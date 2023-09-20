<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_employees()
    {
        $response = $this->get('api/employee');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [],
            'links' => [],
            'meta' => []
        ]);
        Employee::factory()->count(3)->create();
        $this->assertDatabaseCount('employees', 3);
    }
}
