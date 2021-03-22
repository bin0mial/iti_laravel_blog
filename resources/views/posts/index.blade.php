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
                    <a type="button" href="{{ route('posts.show', ['post' => $post->slug]) }}" class="btn btn-primary mr-1 showPostModal" data-toggle="modal" data-target="#exampleModalLong">
                        View
                    </a>
                        <x-button type="primary" buttonType="anchor" :target="route('posts.edit', ['post' => $post->slug])" displayed-name="Edit"/>
                        <form method="POST" id="delete_restore_form" onsubmit="return delete_restore_submit()">
                            @csrf
                            @if($post->trashed())
                                <x-button type="secondary" :target="route('posts.restore', ['post' => $post->id])" displayed-name="Restore"/>
                            @else
                                @method("delete")
                                <x-button type="danger" :target="route('posts.destroy', ['post' => $post->slug])" displayed-name="Delete"/>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Post Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type='button' id="modalGotoPage" class='btn btn-primary'>View In Page</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".showPostModal").click(function (event){
            event.preventDefault();
            $.ajax(event.target.href).done(function (result) {
                $(".modal-body").html(result)
                $("#modalGotoPage").attr("href", event.target.href)
            })
        })

        function delete_restore_submit() {``
            return confirm("Are you sure you want to delete/restore the post?")
        }


    </script>
@endsection
