<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Role;
use App\Country;
use App\State;
use App\City;
use App\User;
use Carbon\Carbon;
use Illuminate\Cache\RetrievesMultipleKeys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Storage;
use File;
use Storage;
use Auth;

class UsersController extends Controller
{
    public function getIndex(){
        $users = User::get();
        $userId = Auth::id();
        $pic = Profile::where('user_id',$userId)->first();
        return view('users.index',compact('users','pic'));
    }

    public function create(){
        $roles = Role::all();
        $countries = Country::all();
        return view('users.create',compact('roles','countries'));
    }

    public function save(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
//            'dob' => 'required',
//            'pic_file' => 'required',
//            'bio' => 'required',
//            'gender' => 'required',
//            'country' => 'required',
//            'state' => 'required',
//            'city' => 'required',
//            'address' => 'required',
//            'postal' => 'required',
            'role' => 'required',

        ],[
            'pic_file.required' => 'Profile picture required',
            'dob.required' => 'Date of Birth required'
        ]);
//        $user->assignRole($role->name);

        $user           = User::firstOrCreate(['name'=>$request->name,'email'=> $request->email]);
        $user->status   = 1;
        $user->password = bcrypt($request->password);
        $user->save();
        if ($file = $request->file('pic_file')) {
            // $extension = $file->extension()?: 'png';
            // $destinationPath = storage_path('/app/public/uploads/users/');
            // $safeName = str_random(10) . '.' . $extension;
            // $file->move($destinationPath, $safeName);
            // $request['pic'] = $safeName;
            $request['pic'] = Storage::disk('uploads')->put('users',$request->pic_file);
        }else{
            $request['pic'] = 'no_avatar.jpg';
        }
        $profile = $user->profile;
        if($user->profile == null){
            $profile = new  Profile();
        }
        if($request->dob != null){
          $date =  Carbon::parse($request->dob)->format('Y-m-d');
        }else{
            $date = $request->dob;
        }
        $profile->user_id = $user->id;
        $profile->bio = $request->bio;
        $profile->gender = $request->gender;
        $profile->dob = $date;
        $profile->country = $request->country;
        $profile->state = $request->state;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->postal = $request->postal;
        $profile->pic = $request['pic'];
        $profile->save();

        $role = Role::find($request->role);
        $user->assignRole($role->name);

        Session::flash('message','User has been added');
        return redirect()->back();
    }

    public function edit(Request $request){
        $user = User::findOrfail($request->id);
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    public function update(Request $request){
 
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
//            'dob' => 'required',
//            'bio' => 'required',
//            'gender' => 'required',
//            'country' => 'required',
//            'state' => 'required',
//            'city' => 'required',
//            'address' => 'required',
//            'postal' => 'required',
            'role' => 'required',

        ],[
            'pic_file.required' => 'Profile picture required',
            'dob.required' => 'Date of Birth required'
        ]);

        $user =  User::findOrfail($request->id);

        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        $profile = $user->profile;
        if($user->profile == null){
            $profile = new  Profile();
        }
        if($request->dob != null){
            $date =  Carbon::parse($request->dob)->format('Y-m-d');
        }else{
            $date = $request->dob;
        }


        if ($file = $request->file('pic_file')) {
          
            $path = '/app/public/uploads/users/';
            // $extension = $file->extension()?: 'png';
            $destinationPath = storage_path($path);
            $safeName = Storage::disk('uploads')->put('users',$request->pic_file);
            // $safeName = str_random(10) . '.' . $extension;
            // dd($safeName);
            // $destinationPath = Storage::disk('uploads')->put('users',$safeName);
            // $safeName = Storage::disk('uploads')->put('users',$request->pic_file);

            // $file->move($destinationPath, $safeName);
            //delete old pic if exists
            if (File::exists($destinationPath . $user->pic)) {
                File::delete($destinationPath . $user->pic);
            }
            //save new file path into db
            $profile->pic = $safeName;
        }

      


        $profile->user_id = $user->id;
        $profile->bio = $request->bio;
        $profile->gender = $request->gender;
        $profile->dob = $date;
        $profile->country = $request->country;
        $profile->state = $request->state;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->postal = $request->postal;
        $profile->save();



        $role = Role::find($request->role);
        if(!$user->hasRole($role->name)){
            $user->roles()->first()->pivot->delete();
            $user->assignRole($role->name);
        }

        Session::flash('message','User has been updated');
        return redirect()->back();
    }

    public function delete($id){
       $user =  User::findOrfail($id);
       $user->delete();
       Session::flash('message','User has been deleted');
       return back();
    }

    public function getDeletedUsers(){
        $users = User::onlyTrashed()->get();
        return view('users.deleted',compact('users'));
    }

    public function restoreUser(Request $request){
        $user =  User::onlyTrashed()->where('id','=',$request->id);
        $user->restore();
        Session::flash('message','User has been restored');
        return back();
    }

    public function getSettings(){
       
        $user = auth()->user();
        return view('users.account-settings',compact('user'));
    }

    public function saveSettings(Request $request){
       
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
        ]);

        $user =  auth()->user();

        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        $profile = $user->profile;
        if($user->profile == null){
            $profile = new  Profile();
        }
        if($request->dob != null){
            $date =  Carbon::parse($request->dob)->format('Y-m-d');
        }else{
            $date = $request->dob;
        }


        if ($file = $request->file('pic_file')) {
             // $extension = $file->extension()?: 'png';
            $destinationPath = storage_path('/app/public/storage/uploads/users/');
            // $safeName = str_random(10) . '.' . $extension;
            // $file->move($destinationPath, $safeName);
            // //delete old pic if exists
            // if (File::exists($destinationPath . $user->pic)) {
            //     File::delete($destinationPath . $user->pic);
            // }
            $safeName = Storage::disk('uploads')->put('users',$request->pic_file);
             if (File::exists($destinationPath . $user->pic)) {
                File::delete($destinationPath . $user->pic);
            }
            //save new file path into db
            $profile->pic = $safeName;
        }


        $profile->user_id = $user->id;
        $profile->bio = $request->bio;
        $profile->gender = $request->gender;
        $profile->dob = $date;
        $profile->country = $request->country;
        $profile->state = $request->state;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->postal = $request->postal;
        $profile->save();

        Session::flash('message','Account has been updated');
        return redirect()->back();
    }


    // by saqlain raza

    
    public function getStates($country_id=null){
        if($country_id == null){
            Session::flash('message','Something went wrong! Please refresh the page');
        }else{
            $states = State::where('country_id',$country_id)->get();
            echo $states;
        }
    }

    public function getCities($state_id=null){
        if($state_id == null){
            Session::flash('message','Something went wrong! Please refresh the page');
        }else{
            $states = City::where('state_id',$state_id)->get();
            echo $states;
        }
    }

}
