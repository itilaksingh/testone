<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\family_type;
use App\occupation;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use Auth;
use App\user_occupation;
use App\user_family_type;
use Illuminate\Support\Facades\DB;




class HomeController extends Controller
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
        $family_type=family_type::all();
        $occupation=occupation::all();

        $getMatches=$this->getMatches();

        return view('home', compact('occupation', 'family_type', 'getMatches'));
    }

  
    public function updateProfile(Request $request)
    {
        $userObj=User::find(Auth::user()->id);

        $error_arr=array();
        if (Auth::user()->gender=='') {
            $error_arr=array_merge($error_arr, array('gender' => 'required',));
            $userObj->gender=$request->gender;


        } if(Auth::user()->dob==''){
            $error_arr=array_merge($error_arr, array('dob' => 'required|date|before:'.Carbon::now()->subYears(18)));
            $userObj->dob=$request->dob;

        } if(Auth::user()->annual_income==''){
            $error_arr=array_merge($error_arr, array('annual_income' => 'required',));
            $userObj->annual_income=$request->annual_income;
        }
      
        $validated = $request->validate($error_arr);


        $userObj->manglik=$request->manglik;

        if ($request->family_type!=null) {
                if ($userObj->familyType->count()>0) {
                    user_family_type::where('user_id', Auth::user()->id)->delete();      
                }
        
              
                foreach($request->family_type as $value){
                    user_family_type::create([
                        'user_id'=>Auth::user()->id,
                        'family_type_id'=>$value
                    ]);
                }
        }
        
        if ($request->occupation!=null) {
                    if ($userObj->occupation->count()>0) {
                        user_occupation::where('user_id', Auth::user()->id)->delete();      
                    }
                foreach($request->occupation as $value){
                    user_occupation::create([
                        'user_id'=>Auth::user()->id,
                        'occupation_id'=>$value
                    ]);
                }
                    
        }

       
       

        if($userObj->save()){
            return ['success'=>1, 'msg'=>'Profile details has been updated successfully.'];
        }else{
            return ['success'=>0, 'msg'=>'please try again'];
        }
    }


   
    private function getMatches(){
        $current_user=Auth::user();
        $match_percentage=0;
        $find_opp_gender='f';
        if ($current_user->gender=='f') {
            $find_opp_gender='m';
        }

        $percentage=0;    


        $other_users=User::where('gender', '=',  $find_opp_gender);

        if($current_user->dob!=''){
            $dob_y=date('Y', strtotime($current_user->dob));         
            $other_users=$other_users->orWhereBetween('dob', ['%'.($dob_y-8).'%', '%'.($dob_y+8).'%']);
            $percentage+=20;
        } if($current_user->manglik!=''){
            $other_users=$other_users->where('manglik','=' ,$current_user->manglik);
            $percentage+=20;
        }


        
      
       
        $other_users=$other_users->active()->orderBy('dob', 'DESC')->paginate(15);


        // if (count($other_users)>0) {
        //     foreach($other_users as $key=>$item){
        //         $other_users[$key]->percantage=$percentage;
        //         $familyTypeUserId=[];
        //         $occupation_userIds=[];
        //         if($current_user->familyType()->count()>0){
        //             $familyTypeUserId=user_family_type::whereIn('family_type_id', $current_user->familyType()->pluck('family_type_id')->toArray())
        //             ->where('user_id', '!=', $current_user->id)
        //             ->pluck('user_id')->toArray();
        //             // dd($familyTypeUserId);
        //         }
        //         if($current_user->occupation()->count()>0){
        //             $occupation_userIds=user_occupation::whereIn('occupation_id', $current_user->occupation()->pluck('occupation_id')->toArray())
        //             ->where('user_id', '!=', $current_user->id)
        //             ->pluck('user_id')->toArray();
        //             // dd($occupation_userIds);
        //         }
        //         $unset_obje=true;
        //         if (count($familyTypeUserId)> 0 && in_array($item->id, $familyTypeUserId)) {
        //             $percentage+=20;
        //             $unset_obje=false;
        //         } 
        //         if (count($occupation_userIds)> 0 && in_array($item->id, $occupation_userIds)) {
        //             $percentage+=20;
        //             $unset_obje=false;
        //         }
        //         if ($unset_obje) {
        //             // $other_users->forget($key);

        //         }
        //     }
        // }


        // print_r($percentage);
        // dd($other_users);
        return  $other_users;
     }

     private function matchPercentage($item=null, $percentage){
        if ($item==null) {
           return 0;
        }
        $percentage=($percentage==null)? 0 : $percentage; 
        $current_user=Auth::user();

        if($current_user->dob!=''){
            $dob_y=date('Y', strtotime($current_user->dob));         
            $other_users=$other_users->orWhereBetween('dob', ['%'.($dob_y-8), '%'.($dob_y+8)]);
            $percentage+=20;
        } if($current_user->manglik!=''){
            $other_users=$other_users->orWhere('manglik','=' ,$current_user->manglik);
            $percentage+=10;
        } 
       
        // if($current_user->occupation()->count()>0 && $item->occupation()->count()>0) {
        //    if () {
        //        # code...
        //    }
        //     $percentage=20;
        // }else if($current_user->familyType()->count()>0 &&  $item->familyType()->count()>0){

        //     $percentage=20;
        // }
            return $percentage;

    }
}
