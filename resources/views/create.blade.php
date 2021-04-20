@extends('layout')

@section('content')
    <h1 class="text-center mt-2 mb-5">画像アップロード</h1>
    <div class="container mb-5">
        {{ Form::open(['route' => 'confirm', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
            @csrf
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">お名前</p>
                <div class="col-sm-8">
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group row">
                <p class="col-sm-4 col-form-label">画像</p>
                <div class="col-sm-8">
                    {{ Form::file('image') }}
                </div>
            </div>

            <div class="text-center">
                {{ Form::submit('確認画面へ', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>

@endsection