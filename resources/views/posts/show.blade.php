@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                @if (asset('images/' . $post->user->image))
                    <div>
                        <img src="{{ asset('images/' . $post->user->image) }}" alt="" style="max-width:100px;">
                    </div>
                @endif
                <h1>{{ $post->title }}</h1>
                <h2>written by : {{ $post->user->name }}</h2>
                <small>Tags: </small>
                @foreach ($post->tags as $tag)
                    {{ $tag->title }},
                @endforeach
            </div>
            <div class="card-body">
                <p>{{ $post->body }}</p>
                <p>Created at: {{ $post->created_at->format('d-m-Y H:i:s') }}</p>
                <p>Last updated: {{ $post->updated_at->format('d-m-Y H:i:s') }}</p>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" id="category" value="{{ $post->category->title }}" readonly>
                </div>
                @if (asset('images/' . $post->image))
                    <div>
                        <img src="{{ asset('images/' . $post->image) }}" alt="" style="max-width:500px;">
                    </div>
                @endif
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4>Comments:</h4>
                            @foreach ($post->comments as $comment)
                                <div class="media">
                                    <img class="mr-3" src="{{ asset('images/' . $comment->user->image) }}"
                                        alt="User Avatar" width="50px">
                                    <div class="media-body">
                                        <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                        <p>{{ $comment->content }}</p>

                                        @if (auth()->check() &&
                                                auth()->user()->can('update', $comment))
                                            <a href="{{ route('comments.edit', ['comment' => $comment]) }}"
                                                class="btn btn-primary">Edit</a>
                                        @endif
                                        @if (auth()->check() &&
                                                auth()->user()->can('delete', $comment))
                                            <form
                                                action="{{ route('comments.destroy', ['post' => $post, 'comment' => $comment->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endif


                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4>Add a Comment:</h4>
                            <form method="POST" action="{{ route('comments.store', ['post' => $post]) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ auth()->user()->name }}"readonly>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Comment:</label>
                                    <textarea name="content" class="form-control" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                @if (auth()->check() &&
                        auth()->user()->can('update', $post))
                    <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-primary">Edit</a>
                @endif
                @if (auth()->check() &&
                        auth()->user()->can('delete', $post))
                    <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST"
                        style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
