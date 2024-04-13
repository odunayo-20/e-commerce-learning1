<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('frontend.users.profile');
    }


    public function updateUserDetails(Request $request){
        $request->validate([
            'username' => 'required|string',
            'phone' => 'required|string|digits:10',
            'address' => 'required|string|max:499',
            'pin_code' => 'required|string|digits:6',
        ]);
        $user = User::findOrFail(Auth::user()->id);
        // dd($user);
        $user->update([
            'name' => $request->username,
        ]);
        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [

                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address,
            ]
        );
session()->flash('message', 'Profile Updated');
        return redirect()->back();
    }

    public function passwordCreate(){
        // dd('ndskmns');
        return view('frontend.users.change-password');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }
}