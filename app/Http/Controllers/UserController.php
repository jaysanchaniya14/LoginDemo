<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $users = User::orderBy('id','desc')->get();

            try {
                return datatables($users)
                     ->addIndexColumn()
                    
                    ->make(true);
            }
            catch (Expression $e) {
                Log::info($e->getMessage());
            }
        }
        return view('user.index');
    }


    public function userindex(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('user.userindex');
    }
  
}
