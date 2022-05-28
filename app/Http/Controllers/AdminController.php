<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use App\User;
use Carbon\Carbon;



class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
     

        return view('admin/home');
    }

    public function getUsersRecords(Request $request){
        if ($request->ajax()) {
            $data = User::where('is_supper_admin', '=', 0)->get();

          
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('annual_income', function($row){
                    
                    return 'INR '.$row->annual_income;
                })
                ->editColumn('gender', function($row){
                    
                    return ($row->gender=='m')? 'Male': 'Female';
                })
                ->editColumn('created_at', function($row){
                    
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
