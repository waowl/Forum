<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create(User::class);
        $this->get("/profiles/{$user->name}")->assertSee($user->name);
    }

    /** @test */
    public function a_profile_contains_threads()
    {
        $user = create(User::class);
        $thread = create(Thread::class, ['user_id' => $user->id]);
        $this->get("/profiles/{$user->name}")->assertSee($thread->title);
    }
}
