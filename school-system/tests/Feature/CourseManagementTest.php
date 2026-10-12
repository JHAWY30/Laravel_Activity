<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_pages_load(): void
    {
        $this->get(route('courses.index'))->assertOk();
        $this->get(route('courses.create'))->assertOk();
    }

    public function test_course_can_be_created(): void
    {
        $response = $this->post(route('courses.store'), [
            'code' => 'MATH101',
            'title' => 'Mathematics',
            'credits' => 3,
        ]);

        $response->assertRedirect(route('courses.index'));
        $this->assertDatabaseHas('courses', [
            'code' => 'MATH101',
            'title' => 'Mathematics',
            'credits' => 3,
        ]);
    }

    public function test_course_code_must_be_unique_and_credits_positive(): void
    {
        Course::create([
            'code' => 'MATH101',
            'title' => 'Mathematics',
            'credits' => 3,
        ]);

        $response = $this->from(route('courses.create'))
            ->post(route('courses.store'), [
                'code' => 'MATH101',
                'title' => 'Duplicate Mathematics',
                'credits' => 0,
            ]);

        $response->assertRedirect(route('courses.create'));
        $response->assertSessionHasErrors(['code', 'credits']);
    }
}
