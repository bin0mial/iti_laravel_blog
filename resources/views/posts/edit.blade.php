@extends("layouts.app")

@section("title", "Edit Post")

@section("content")
    <div class="mt-4">
        <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $post->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="post_creator">Post Creator</label>
                <select class="form-control" id="user_id" name="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $post->user_id? "selected": "" }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
