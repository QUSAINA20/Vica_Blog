@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Category') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('categories.update', ['category' => $category]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">{{ __('Tilte') }}</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" required value="{{ old('title', $category->title) }}"
                                        autofocus>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">{{ __('Image') }}</label>
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @if (asset('images/' . $category->image))
                                    <div class="form-group">
                                        <label for="current_image">{{ __('Current Image') }}</label>
                                        <div>
                                            <img src="{{ asset('images/' . $category->image) }}" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                        <a href="{{ route('categories.index') }}"
                                            class="btn btn-secondary">{{ __('Cancel') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
