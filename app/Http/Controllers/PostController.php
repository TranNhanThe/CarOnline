<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    //
    public function index(){
        // $allPosts = Post::all();
        // dd($allPosts);

        // $post = Post::find('c1');
        // dd($post);

        // $post = new Post;
        // $post->title = 'Bài viết 3';
        // $post -> content = 'Nội dung 3';
        // $post -> status = 1;
        // $post -> save();

        echo '<h2>Query Eloquent Model</h2>';
////////////////////////////////////////////
        //tat ca post
        // $allPosts = Post::all();

        // if($allPosts->count()>0) {
        //     foreach ($allPosts as $item){
        //         echo $item->title.'<br/>';
        //     }
        // }
///////////////////////////////////
        // $detail = Post::find(1);

        // dd($detail);
///////////////////////////////////////
        //////////////////////
        //$activePosts = Post::where('status', 1)->orderBy('id', 'desc')->get();

        //dd($activePosts); 

        //  if($activePosts->count()>0) {
        //     foreach ($activePosts as $item){
        //         echo $item->title.'<br/>';
        //     }
        // }
        ////////////////////////

        // $activePosts = Post::all();
        // $activePosts->reject(function ($post) {
        //     return $post->status==1; 
        // });

        // dd($activePosts); 

        $allPosts = Post::where('status', 1)->cursor();

       // dd($allPosts);

        foreach ($allPosts as $item){
            echo $item->title.'<br/>';
        }
    
        
    }
    public function add()
    {
        $dataInsert = [
            'title' => 'Cập nhật valorant 2020',
            'content' => 'Phát hiện bug làm cho Omen teleport ra khỏi map, neft Chamber.',
            'status' => 1
        ];

        //insert dùng mảng kiểu:
        // $post = Post::create($dataInsert);

        // echo 'Id vừa insert: '.$post->id;
        ///////////////////////////////////////////
        // $insertStatus = Post::insert($dataInsert);
        // dd($insertStatus); 
///////////////////////////////////////////////
        //insert kiểu firstorcreate
        // $post = Post::firstOrCreate([
        //     'id' => 23
        // ], $dataInsert);
        //dd($post);
//////////////////////////////

        //
        $check = true;
        $post = new Post;
        $post->title = 'Bài viết mới';
        $post->content = 'Nội dung mới';
        if($check){
            $post->status = 1;
        }
        $post->save();

        echo 'Id vừa insert: '.$post->id;
        //dd($post);
        
    }
}
