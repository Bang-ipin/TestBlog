<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $page_title				    = 'Daftar User';
        $dataUser                   = User::get();
        return view('admin.user.list',compact(['page_title','dataUser']));

    }

    public function create()
    {
        $page_title                 = 'Tambah Data';
        $dd_role                    = $this->dd_role();
        
        $data['username']           = '';
        $data['password']		    = '';
        $data['name']			    = '';
        $data['role']			    = '';

        return view('admin.user.create',compact(['dd_role','page_title']))->with($data);
    }

    public function store(Request $request)
    {
        User::create([
            'username' 			    => $request->username,
            'password'	    		=> Hash::make($request->password),
            'name'  		        => $request->name,
            'role' 			        => $request->role,
        ]);
        return redirect('admin/user')->with('SUCCESSMSG','Data Added Successfully');
    }

    public function edit($id)
    {
        $query 	                    = User::where('username','=',$id)->get();
        if($query->count() > 0){
            
            foreach($query as $db){
                $data['username']		= $db->username;
                
            }
        }
        else{
                $data['username']   = $id;
                $data['name']		= '';
                $data['role']	    = '';
            
        }
        
        $page_title 				= 'Edit User';
        $dd_role                    = $this->dd_role();

        return view('admin.user.edit',compact(['page_title','dd_role']))->with($data);
    }
    public function update(Request $request)
    {
        $data =[ 
            'username'  		    => $request->username,
            'name' 			        => $request->name,
            'role' 			        => $request->role,
            'password'	    		=> Hash::make($request->password)
        ];

        $id						    = $request->username;
       
        if(empty($request->password)){
            $user                   = User::where('username','=',$id)->update($data);
            return redirect('admin/user')->with('SUCCESSMSG','Data berhasil di update');
        }else{
            $user                   = User::where('username','=',$id)->update($data);
            return redirect('admin/user')->with('SUCCESSMSG','Data berhasil diupdate');
        }
    }

    public function destroy(Request $request)
    {
        $id                         = $request->username;
        $user                       = User::where('username',$id)->get();
        $user->delete();
        return redirect('admin/user')->with('SUCCESSMSG','berhasil menghapus data user');
    }

    public function show()
	{
		$total                      = User::get()->count();
		$length                     = intval($_REQUEST['length']);
		$length                     = $length < 0 ? $total: $length; 
		$start                      = intval($_REQUEST['start']);
		$draw                       = intval($_REQUEST['draw']);
		
		$search                     = $_REQUEST['search']["value"];
		
		$output                     = array();
		$output['data']             = array();
		
		$end                        = $start + $length;
		$end                        = $end > $total ? $total : $end;

		$query                      = User::take($length)->skip($start)->orderBy('id','DESC')->get();
		
		if($search!=""){
        $query                      = User::orWhere('name','like','%'.$search.'%')->orderBy('id','DESC')->get();
		$output['recordsTotal']     = $output['recordsFiltered']=$query->count();
		}

		$no=$start+1;
		foreach ($query as $user) {
            if ($user->id == 1 ){
                $cek = "<a class='btn btn-sm btn-info btn-clean btn-icon' title='Edit details'  href=".url('admin/user/'.$user->id.'/edit')."><i class='la la-edit'></i></a>
                ";
                }else{
                $cek= "
                    <a href=".url('admin/user/'.$user->id.'/edit')." class='btn btn-sm btn-info btn-clean btn-icon' title='Edit details' ><i class='la la-edit' ></i></a>
                    <a href='javascript:;' class='btn btn-sm btn-danger btn-clean btn-icon' title='Delete' onclick='hapusid($user->id)'><i class='la la-trash' ></i></a>
                   ";
                }
           $output['data'][]=
					array(
						$no,
						$user->username,
						$user->name,
						$user->role,
                        $cek
                );
		$no++;
		}
		
		$output['draw']             = $draw;
		$output['recordsTotal']     = $total;
		$output['recordsFiltered']  = $total;
		
		return response()->json($output);

    }
    public function cekemail(Request $request)
	{
		$username          = $request->username;
		$cek            = User::select('username')->where('username',$username)->get();
		if($cek->count() == 0)
		{
			return response()->json([
                'valid'=>'true'
            ]);
		
		}
		else
		{
			return response()->json([
                'valid'=>'false'
            ]);
		}
	}

    public function dd_role()
    {
        $dd['']             = 'Pilih';
        $dd['1']            = 'Admin';
        $dd['2']            = 'Editor';
        return $dd;
    }

}
