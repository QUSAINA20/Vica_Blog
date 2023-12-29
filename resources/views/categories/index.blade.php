@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Categories</h1>

                @if (auth()->check() &&
                        auth()->user()->can('delete', $categories->first()))
                    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tilte</th>
                            <th>Posts Numbers</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->title }}</td>

                                <td>{{ $category->posts()->count() }}</td>
                                <td>
                                    <a href="{{ route('categories.show', ['category' => $category]) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    @if (auth()->check() &&
                                            auth()->user()->can('update', $category))
                                        <a href="{{ route('categories.edit', ['category' => $category]) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                    @if (auth()->check() &&
                                            auth()->user()->can('delete', $category))
                                        <form action="{{ route('categories.destroy', ['category' => $category]) }}"
                                            method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
