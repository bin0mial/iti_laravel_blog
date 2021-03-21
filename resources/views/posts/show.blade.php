@extends(!isset($ajax)?"layouts.app":"layouts.empty")
@section("title", $post["title"] . " | ITI Blog")

@section("content")
    <div class="card mt-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title"><b>Title :-</b> {{ $post->title }}</h5>
            <p class="card-text">
                <b>Description :-</b>
                <p>{{ $post->description }}</p>
            </p>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Post Creator
        </div>
        <div class="card-body">
            <p class="card-text"><b>Name :-</b> {{ $post->user->name }}</p>
            <p class="card-text"><b>Email :-</b> {{ $post->user->email }}</p>
            <p class="card-text"><b>Created At :-</b> {{ $post->getHumanReadableDate()}}</p>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">
            @forelse($post->comments as $comment)
                <div class="card mt-4">
                    <div class="card-header">
                        <b>{{ $comment->user->name }}</b>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $comment->comment }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center">No comments yet!</div>
            @endforelse
        </div>
    </div>
@endsection
