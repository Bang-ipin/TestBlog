<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $dd_username                = self::dd_username();
        $data['title']              = '';
        $data['content']		    = '';
        $data['author']		        = '';

        return view('admin.blogs.form', compact(['page_title','dd_username']))->with($data);
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

    public function dd_username()
    {
        $query                      = User::join('post','account.username','post.username')->select('account.username')->get();
        $dd['']                     = '---Pilih Username---';
        if ($query->count() > 0) {
            foreach ($query as $row) {
                $dd[$row->username] = $row->name;
            }
        }
        return $dd;
    }
}
