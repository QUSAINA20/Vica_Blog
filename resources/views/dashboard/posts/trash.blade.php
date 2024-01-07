@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <h2 class="my-4">Trash</h2>
        <a href="{{ route('posts.index') }}" class="btn btn-primary mb-3">Back to posts</a>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>

                    <th>tags</th>

                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($trashedPosts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->title }}</td>
                        <td>
                            @foreach ($post->tags as $tag)
                                {{ $tag->title }},
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>

                            <form action="{{ route('posts.force-delete', $post->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to permanently delete this service?')">Force
                                    Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No posts in the trash.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
