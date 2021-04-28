@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" style="width:30%">グッズ名</th>
                <th scope="col">画像</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></td>
                <td><img src="{{ asset('img/'. $post->id . "/" . $post->image) }}</td>
            </tr>
            @endforeach
        </tbody>
        
        <div class='paginate'>
            {{ $posts->links() }}
        </div>        
    </table>
</div>
@endsection

