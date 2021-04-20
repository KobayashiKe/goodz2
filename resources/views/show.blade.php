@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h1 class="title">
            {{ $post->title }}
        </h1>
        
        <div class="content">
            <div class="content__post">
                <p>{{ $post->body }}</p>    
            </div>
        </div>
        
        <p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
        
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">delete</button> 
        </form>        
        
        <div class="footer">
            <a href="/index">戻る</a>
        </div>
    </div>

@endsection