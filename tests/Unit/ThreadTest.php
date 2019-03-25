<?php

namespace Tests\Unit;

use App\Channel;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * */
    public function a_thread_has_a_reply()
    {
        $thread = factory(Thread::class)->create();

        $thread->addReply([
            'body' => 'body',
            'user_id' => 1
        ]);

        $this->assertCount(1, $thread->replies);
    }

    /**
     * @test
     *
     * */
    public function a_thread_has_replies()
    {
        $thread = factory(Thread::class)->create();

        $this->assertInstanceOf(Collection::class, $thread->replies);

    }

    /**
     * @test
     *
     * */
    public function a_thread_makes_a_path()
    {
        $thread = create(Thread::class);

        $this->assertEquals("/thread/{$thread->channel->slug}/{$thread->id}", $thread->path());
    }

    /**
     * @test
     *
     * */
    public function a_thread_belongs_to_a_channel()
    {
        $thread = factory(Thread::class)->create();

        $this->assertInstanceOf(Channel::class, $thread->channel);

    }

    /**
     * @test
     *
     * */
    public function a_thread_has_a_creator()
    {
        $thread = factory(Thread::class)->create();

        $this->assertInstanceOf(User::class, $thread->creator);
    }

    /** @test */
    public function a_user_can_delete_a_thread()
    {
        $user = create(User::class);
        $this->signIn($user);
        $thread = create(Thread::class, ['user_id' => $user->id]);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $this->delete($thread->path());
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function a_guest_cant_delete_a_thread()
    {
        $thread = create(Thread::class);

        $this->delete($thread->path())->assertRedirect('/login');
    }

}
