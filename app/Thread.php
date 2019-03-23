<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope('replyCount', function ($builder) {
           return $builder->withCount('replies');
        });
    }

    protected $guarded = [];

    public function path()
    {
        return "/thread/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)
            ->withCount('favorites');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function addReply(array $reply)
    {
        $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
