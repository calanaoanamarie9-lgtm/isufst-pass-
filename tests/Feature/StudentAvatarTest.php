<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentAvatarTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_upload_avatar(): void
    {
        Storage::fake('public');

        $user = \App\Models\User::factory()->create(['role' => 'student']);
        $user->studentProfile()->create();

        $this->actingAs($user)
            ->put('/student/profile', [
                'avatar' => UploadedFile::fake()->image('me.jpg', 200, 200),
            ])
            ->assertRedirect();

        $this->assertNotNull($user->studentProfile->refresh()->avatar);

        $this->actingAs($user)
            ->get('/student/profile')
            ->assertOk()
            ->assertSee('storage/avatars/');
    }

    public function test_student_can_remove_avatar(): void
    {
        Storage::fake('public');

        $user = \App\Models\User::factory()->create(['role' => 'student']);
        $profile = $user->studentProfile()->create(['avatar' => 'avatars/old.jpg']);
        Storage::disk('public')->put('avatars/old.jpg', 'data');

        $this->actingAs($user)
            ->put('/student/profile', ['remove_avatar' => '1'])
            ->assertRedirect();

        $this->assertNull($profile->refresh()->avatar);
        Storage::disk('public')->assertMissing('avatars/old.jpg');
    }
}