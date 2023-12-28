@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $tag->title }}</h1>
            </div>

            <div class="card-footer">
                <a href="{{ route('tags.edit', ['tag' => $tag]) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                </form>
            </div>
        </div>


    </div>
@endsection
