@extends("layouts.app")

@section("title", "Create Post")

@section("content")
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mt-4">
        <form method="POST" action="{{route('posts.store')}}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"> </textarea>
            </div>
            <div class="form-group">
                <label for="user_id">Post Creator</label>
                <select class="form-control" id="user_id" name = "user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create Post</button>
        </form>
    </div>
@endsection
