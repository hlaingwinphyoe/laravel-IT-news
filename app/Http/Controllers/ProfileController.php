<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        return view("user-profile.profile");
    }

    public function editPhoto(){
        return view("user-profile.edit-photo");
    }

    public function editPassword(){
        return view("user-profile.edit-password");
    }

    public function editNameEmail(){
        return view("user-profile.edit-name-email");
    }

    public function changePassword(Request $request){

        $request->validate([

            'current_password' => ['required', new MatchOldPassword()],

            'new_password' => ['required','min:8'],

            'new_confirm_password' => ['same:new_password'],

        ]);

        $user = new User();

        // find current Login User
        $currentUser = $user->find(Auth::id());
        $currentUser->password = Hash::make($request->new_password);
        $currentUser->update();

        // login again
        Auth::logout();
        return redirect()->route("login");

    }

    public function changeEmail(Request $request){
        $request->validate([
           'email' => 'required|email|unique:users,email|min:5|max:50',
        ]);

        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->update();

        return redirect()->route("profile.edit.name.email")->with("emailStatus","Email has changed.");

    }

    public function changeName(Request $request){
        $request->validate([
            "name" => 'required|min:3|max:50'
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->update();

        return redirect()->route("profile.edit.name.email")->with("status","Name has changed");
    }

    public function changePhoto(Request $request){
        $request->validate([
            "photo" => "required|mimetypes:image/jpeg,image/png|file|max:2500"   // dimensions:ratio=1/1| ပုံလေးထောင့်လိုချင်ရင် ထည့်စစ်
        ]);
        $dir = "public/profile";

        Storage::delete($dir.Auth::user()->photo);

        $newName = uniqid()."_photo.".$request->file("photo")->getClientOriginalExtension();
        $request->file("photo")->storeAs($dir,$newName);

        $user = User::find(Auth::id());
        $user->photo = $newName;
        $user->update();
        return redirect()->route("profile.edit.photo")->with("status","Profile has changed");

    }

}
