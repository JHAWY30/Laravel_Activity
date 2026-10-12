<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_list_includes_a_delete_action(): void
    {
        $student = Student::create([
            'student_number' => 'STU-001',
            'first_name' => 'Taylor',
            'last_name' => 'Student',
            'email' => 'taylor@example.com',
            'date_of_birth' => '2005-01-15',
        ]);

        $this->get(route('students.index'))
            ->assertOk()
            ->assertSee(route('students.destroy', $student), false)
            ->assertSee('Delete');
    }

    public function test_student_can_be_deleted(): void
    {
        $student = Student::create([
            'student_number' => 'STU-002',
            'first_name' => 'Jordan',
            'last_name' => 'Student',
            'email' => 'jordan@example.com',
            'date_of_birth' => '2005-02-20',
        ]);

        $this->delete(route('students.destroy', $student))
            ->assertRedirect(route('students.index'))
            ->assertSessionHas('success', 'Student record deleted.');

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
