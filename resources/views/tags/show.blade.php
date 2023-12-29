@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>{{ $tag->title }}</h1>
            </div>

            <div class="card-footer">

                @if (auth()->check() &&
                        auth()->user()->can('update', $tag))
                    <a href="{{ route('tags.edit', ['tag' => $tag]) }}" class="btn btn-warning btn-sm">Edit</a>
                @endif
                @if (auth()->check() &&
                        auth()->user()->can('delete', $tag))
                    <form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>


    </div>
@endsection
