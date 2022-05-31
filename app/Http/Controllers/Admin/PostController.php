<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $page_title                 = 'List Artikel';
        $Blog                       = Post::get();
        return view('admin.blogs.list', compact(['page_title','Blog']));
    }

    public function create()
    {
        $page_title                 = 'Tambah Artikel';

        $data['title']              = '';
        $data['content']		    = '';

        return view('admin.blogs.form', compact(['page_title']))->with($data);
    }
    public function store(Request $request)
    {
        $data = [
            'title'                 => $request->title,
            'content'               => $request->content,
            'date'                  => Carbon::now(),
            'username'              => Auth::user()->username,
        ];
        Post::create($data);
        return redirect('admin/articles')->with('SUCCESSMSG', 'Data Berhasil di Tambah');
    }
}
