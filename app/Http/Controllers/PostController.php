<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('index')->with(['posts' => $post->getPaginateByLimit()]);
    }

    // 特定IDのpostを表示する
    public function show(Post $post)
    {
        return view('show')->with(['post' => $post]);
    }
    
    // 投稿フォーム
    public function create()
    {
        return view('create');
    }
    
    public function confirm(PostRequest $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'body' => 'required',
        ]);
        
        $title = $request->title;
        $body = $request->body;
        
        //ファイル名取得
        $imageName = $request->file('image')->getClientOriginalName();
        
        //拡張子のみ取得
        $extension = $request->file('image')->getOriginalExtension();
        
        //新しいファイル名作成
        $newImageName = pathInfo($imageName, PATHINFO_FILENAME). "_" . uniqid() . "." . $extension;
        
        $request->file('image')->move(public_path(). "/img/tmp", $newImageName);
        $image = "/img/tmp" . $newImageName;
        
        return view('confirm', [
            'title' => $title,
            'image' => $image,
            'newImageName' => $newImageName,
            'body' => $body,
        ]);
    }
    
    public function complete(PostRequest $request)
    {
        $uploader = new Post();
        $uploader->title = $request->title;
        $uploader->image = $request->image;
        $uploader->body = $request->body;
        $uploader->save();
        
        //idを取得
        $lastInsertedId = $uploader->id;
        
        //ディレクトリ作成
        if(!file_exists(public_path() . "/img/" . $lastInsertedId)) {
            mkdir(public_path . "/img/" . $lastInsertedId, 0777);
        }
        
        //一時保存場所→本番の格納場所へ
        rename(public_path . "/img/tmp/" . $request->image, public_path() . "/img/" . $lastInsertedId . "/" . $request->image);
        
        //一時保存の画像を削除
        \File::cleanDirectory(public_path() . "/img/tmp");
        
        
        return view('complete');
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/index');
    }
}
