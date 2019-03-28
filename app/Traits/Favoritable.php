<?php


namespace App\Traits;


use App\Favorite;

trait Favoritable
{

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {

        $this->favorites()->create(['user_id' => auth()->id()]);
    }

    public function unfavorite()
    {
        $this->favorites()->delete(['user_id' => auth()->id()]);
    }

    public function isFavorited()
    {
        return !!$this->favorites()->where(['user_id' => auth()->id()])->count();
    }
}
