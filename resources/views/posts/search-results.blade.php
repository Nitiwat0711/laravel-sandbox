@extends('layouts.main')

@section('content')
    <h1>Search Result</h1>
    @if (Auth::check())
        <p>Hello {{ Auth::user()->name }}</p>
    @endif

    @can('create', \App\Models\Post::class)
        <a href="{{ route('posts.create') }}">สร้างโพสต์ใหม่</a>

    @else
        <p>คุณไม่มีสิทธิ์สร้างโพสต์ใหม่</p>
    @endcan

    <div class="row">
        <div class="col">
        </div>
        <div class="col-6">
            <div class="d-inline  ml-3">
                <form action="{{ route('posts.search') }}" method="GET">
                    @csrf
                    <input class="form-control" type="text" placeholder="Search" name="title" aria-label="Search">
                    <div class="mt-1" style="text-align: right">
                        <button type="submit" class="btn btn-dark">ค้นหา</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    {{ $posts->links() }}
    @foreach($posts as $post)
    <div class="card mb-3" style="width: 36rem;">

        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">
                {{ $post->created_at->diffForHumans() }}
                <h5>BY</h5> {{ $post->user->name }}
                </p>
            <a href="{{ route('posts.show', ['post' => $post->id]) }}"
               class="btn btn-primary">Go to post</a>

        </div>
    </div>
    @endforeach


@endsection
