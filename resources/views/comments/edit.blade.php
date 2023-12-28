@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit comment') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">{{ __('Content') }}</label>
                                    <textarea name="content" class="form-control" rows="5" required>{{ $comment->content }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                        <a href="{{ route('posts.show', $comment->post_id) }}"
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
