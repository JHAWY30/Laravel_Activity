<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityDueDateTest extends TestCase
{
    use RefreshDatabase;

    public function test_activity_due_date_is_saved_and_displayed_in_application_timezone(): void
    {
        config(['app.timezone' => 'Asia/Manila']);

        $course = Course::create([
            'code' => 'MATH101',
            'title' => 'Mathematics',
            'credits' => 3,
        ]);

        $response = $this->post(route('activities.store'), [
            'course_id' => $course->id,
            'title' => 'Assignment',
            'description' => 'Complete the exercises.',
            'max_points' => 100,
            'due_date' => '2030-04-05T14:30',
        ]);

        $activity = Activity::firstOrFail();

        $response->assertRedirect(route('activities.show', $activity));
        $this->assertSame('2030-04-05 14:30:00', $activity->getRawOriginal('due_date'));
        $this->assertSame('2030-04-05 14:30', $activity->due_date->format('Y-m-d H:i'));
    }

    public function test_activity_due_date_must_match_datetime_local_format(): void
    {
        $course = Course::create([
            'code' => 'MATH101',
            'title' => 'Mathematics',
            'credits' => 3,
        ]);

        $response = $this->from(route('activities.create'))
            ->post(route('activities.store'), [
                'course_id' => $course->id,
                'title' => 'Assignment',
                'description' => 'Complete the exercises.',
                'max_points' => 100,
                'due_date' => 'not-a-date',
            ]);

        $response->assertRedirect(route('activities.create'));
        $response->assertSessionHasErrors('due_date');
        $this->assertDatabaseCount('activities', 0);
    }
}
