<div class="card mt-2" id="reply{{$reply->id}}">
    <div class="card-header d-flex flex-row justify-content-between">
        <div>
            <a href="/profiles/ {{$reply->owner->name}}"> {{$reply->owner->name}}</a> said  {{$reply->created_at->diffForHumans()}}s
        </div>
        <form method="post" action="/reply/{{$reply->id}}/favorite" class="form">
            @csrf
            <button class="btn btn-link" type="submit"><i class="{{$reply->isFavorited() ? 'fas fa-heart text-danger' : 'far fa-heart text-danger'}}"></i> {{$reply->favorites_count}}</button>
        </form>
    </div>
    <div class="card-body">
        {{$reply->body}}
    </div>
</div>
