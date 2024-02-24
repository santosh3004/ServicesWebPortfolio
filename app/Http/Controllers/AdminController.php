<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification=array(
            'alert-type'=>'success',
            'message'=>'Logout Successful'
        );

        return redirect('/login')->with($notification);
    }

    public function profile(){
        $id= Auth::user()->id;
        $adminData=User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function editprofile(){
        $id= Auth::user()->id;
        $adminData=User::find($id);
        return view('admin.admin_profile_edit',compact('adminData'));
    }

    public function storeprofile(Request $request){
        $id= Auth::user()->id;
        $adminData=User::find($id);
        $adminData->name=$request->name;
        $adminData->username=$request->username;
        $adminData->email=$request->email;

        if($request->file('profile_image')){
            $file=$request->file('profile_image');
            $filename = date('ymdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $adminData['profile_image']=$filename;
        }

        $adminData->save();

        $notification= array(
            'alert-type'=>'success',
            'message'=>'Admin Profile Updated Successfully'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changepassword(){
        return view('admin.admin_change_password');
    }

    public function updatepassword(Request $request){
        $validatedData=$request->validate([
            'oldpassword'=>'required',
            'newpassword'=>'required',
            'confirm_password'=>'required|same:newpassword',
        ]);

        $hashpassword=Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashpassword)){
            $user=User::find(Auth::id());
            $user->password=bcrypt($request->newpassword);
            $user->save();

            session()->flash('message','Password updated successfully');
            return redirect()->back();
        }else{
            session()->flash('message','Old password does not match');
            return redirect()->back();
        }
    }
}
