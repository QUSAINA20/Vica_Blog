@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $category->title }}</h1>
            </div>
            <div class="card-body">

                @if (asset('images/' . $category->image))
                    <div>
                        <img src="{{ asset('images/' . $category->image) }}" alt="" style="max-width:500px;">
                    </div>
                @endif
            </div>
            <div class="card-footer">
                @if (auth()->check() &&
                        auth()->user()->can('update', $category))
                    <a href="{{ route('categories.edit', ['category' => $category]) }}" class="btn btn-warning">Edit</a>
                @endif
                @if (auth()->check() &&
                        auth()->user()->can('delete', $category))
                    <form action="{{ route('categories.destroy', ['category' => $category]) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="mt-5">
            <h2>Posts in this Category:</h2>
            @if ($category->posts->count() > 0)
                <ul>
                    @foreach ($category->posts as $post)
                        <li><a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>No posts in this category yet.</p>
            @endif
        </div>
    </div>
@endsection
