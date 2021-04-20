@extends('layouts.app')

@section('content')
<div class="container">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class='posts'>
            @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                <p class='body'>{{ $post->body }}</p>
            </div>
            @endforeach
        </div>
        
        <div class='paginate'>
            {{ $posts->links() }}
        </div>        
</div>
@endsection

