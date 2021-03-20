@extends("layouts.app")

@section("title", "Display All Posts")

@section("content")
    <div class="d-flex justify-content-center my-4">
        <x-button type="success" :target="route('posts.create')" displayed-name="Create Post"/>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <th scope="row">{{ $post["id"] }}</th>
                <td>{{ $post["title"] }}</td>
                <td>{{ $post["creator"]["name"] }}</td>
                <td>{{ $post["created_at"] }}</td>
                <td>
                    <x-button type="info" :target="route('posts.show', ['post' => $post['id']])" displayed-name="View"/>
                    <x-button type="primary" :target="route('posts.edit', ['post' => $post['id']])"
                              displayed-name="Edit"/>
                    <x-button type="danger" :target="route('posts.destroy', ['post' => $post['id']])" displayed-name="Delete"/>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

@endsection
