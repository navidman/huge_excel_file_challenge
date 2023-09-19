<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    public function test_excels_can_be_uploaded(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('import.csv', 1000);
        $response = $this->withHeaders([
            'Content-Type' => 'multipart/form-data',
        ])->post('/api/employee', ['file' => $file]);
        $response->assertStatus(200);
        Storage::disk('public')->assertExists('employee/excel/' . $file->name);
    }
}
