@extends("layouts.app")

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
@endsection
