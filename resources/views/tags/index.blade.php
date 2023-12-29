@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tags</h1>
                @if (auth()->user()->is_admin)
                    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Create Tag</a>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tilte</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->title }}</td>
                                <td>
                                    <a href="{{ route('tags.show', ['tag' => $tag]) }}" class="btn btn-info btn-sm">View</a>
                                    @if (auth()->check() &&
                                            auth()->user()->can('update', $tag))
                                        <a href="{{ route('tags.edit', ['tag' => $tag]) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                    @if (auth()->check() &&
                                            auth()->user()->can('delete', $tag))
                                        <form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
