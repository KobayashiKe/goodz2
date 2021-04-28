@extends('layouts.app')

@section('content')
    <h3 class="container text-left mt-2 mb-5">新規作成</h3>
    <div class="container mb-5">
        {{ Form::open(['route' => 'confirm', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            @csrf
            <div class="text-left">
                <h4>グッズ名</h4>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title_error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
            <div class="text-left">
            	<input type="file" name="post[file]" accept="image/png, image/jpeg"/>
            	<p class="file_error" style="color:red">{{ $errors->first('post.file') }}</p>
            </div>
            
            <div class="text-left">
                <h4>説明文</h4>
                <textarea name="post[body]" placeholder="グッズの説明">{{ old('post.body') }}</textarea>
                <p class="body_error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            
            <div class="text-left">
                {{ Form::submit('確認画面へ', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
        
        <div class="back">
            <a href="/">戻る</a>
        </div>
        
    </div>

@endsection