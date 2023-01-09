<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

  
}
