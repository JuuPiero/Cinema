<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Account\postLogin;
use App\Http\Requests\Account\EditProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function post_login(postLogin $request){
        if(Auth::attempt($request->only('email', 'password'))){
            $admin = Auth::user()->name;
            Alert::success('Welcome', "$admin");
            return redirect()->route('Dashboard');
       }else{
        Alert::warning('error', 'Incorrect account information!');
            return redirect()->back();
            
       };
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login_admin');
    }

    public function index()
    {
        return view('back-end.manage.dashboard.index');
    }
   
    public function create()
    {
        $listData = Blog::get();
        $Count = Blog::count();
        return view('back-end.manage.account.profile-admin', compact('listData', 'Count'));
    }

    public function editProfile(){
        return view('back-end.manage.account.edit-profile-admin');
    }

    public function post_editProfile(EditProfile $request){
        if($request->has('image')){
            $file = $request->image;
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move('Uploads', $fileName);
        }else{
            $fileName = $request->oldImage;
        }
        $Role = $request->role;
        $CheckAdmin = User::where('role', $Role)->first();
        $CheckAdmin->update([
            'image'=>$fileName,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)
        ]);
        Alert::success('Success', 'Successfully Update Profile.');
        return redirect()->route('dashboard.create');
    }
  
}