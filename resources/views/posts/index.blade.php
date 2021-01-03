@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('posts') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Post title...">

                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" name="body" id="body" rows="3" placeholder="Post body..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if($posts->count())
                    @foreach($posts as $post)
                        <div class="card mt-3">
                            <div class="card-header">
                                {{ $post->title }} - {{ $post->created_at->diffForHumans() }}
                            </div>
                            <div class="card-body">
                                {{ $post->body }}
                                <div class="d-flex mt-3">
                                    @if(!$post->likedBy(auth()->user()))
                                        <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">Like</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('posts.like', $post) }}" method="post" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Dislike</button>
                                    </form>
                                    <span>{{ $post->likes->count() }} like(s)</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('profile.show', ['user_id' => $post->user->id]) }}">
                                    <small><i>By: {{ $post->user->name }}</i></small>
                                </a>

                                @if($post->ownedBy(auth()->user()))
                                    <form action="{{ route('posts.destroy', $post) }}" method="post" class="float-right">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-3">
                        {{ $posts->links() }}
                    </div>
                @else
                    <p>No posts yet...</p>
                @endif
            </div>
        </div>
    </div>

@endsection