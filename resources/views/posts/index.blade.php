@extends("layouts.app")

@section("title", "Display All Posts")

@section("content")
    <div class="d-flex justify-content-center my-4">
        <x-button type="success" buttonType="anchor" :target="route('posts.create')" displayed-name="Create Post"/>
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
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->created_at->toDateString() }}</td>
                <td>
                    <div class="d-flex flex-row">
                    <x-button type="info" id="show" buttonType="anchor" :target="route('posts.show', ['post' => $post['id']])" displayed-name="View"/>
                    <x-button type="primary" buttonType="anchor" :target="route('posts.edit', ['post' => $post['id']])" displayed-name="Edit"/>
                    <form method="POST" id="delete_restore_form" onsubmit="return delete_restore_submit()">
                        @csrf
                        @if($post->trashed())
                            <x-button type="secondary" :target="route('posts.restore', ['post' => $post['id']])" displayed-name="Restore"/>
                        @else
                            @method("delete")
                            <x-button type="danger" :target="route('posts.destroy', ['post' => $post['id']])" displayed-name="Delete"/>
                        @endif
                    </form>
                    </div>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    <script>

        function delete_restore_submit() {
            return confirm("Are you sure you want to delete/restore the post?")
        }


    </script>
@endsection
